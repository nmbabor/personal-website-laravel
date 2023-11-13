<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\PricingPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PurchaseController extends Controller
{
    public function pricingPlan()
    {
        $pricingPlans = PricingPlan::whereStatus(1)->orderBy('serial_num', 'ASC')->get();
        return view('backend.purchase.pricingPlan', compact('pricingPlans'));
    }
    public function checkout($id)
    {
        $plan = PricingPlan::whereStatus(1)->findOrFail($id);
        return view('backend.purchase.checkout', compact('plan'));
    }

    public function purchase(Request $request)
    {
        $request->validate([
            'pricing_plan_id' => 'required',
            'total_amount' => 'required',
            'payment_method' => 'required',
        ]);

        if($request->payment_method == 'aamarpay'){
            $url = route('aamarpay.process').'?plan='.$request->pricing_plan_id;
            if($request->discount_code != null){
                $url .= '&discount_code='.$request->discount_code; 
            }
            return redirect($url);
        }

        $input = $request->except('_token');

        if ($request->hasFile("pop_photo")) {
            $input['pop_photo'] = uploadBigImageAndGetPath($request->file("pop_photo"), "assets/images/payment");
        }

        $input['invoice_no'] =  time() . '-' . rand(10000, 99999);
        $input['user_id'] = Auth::user()->id;
        $myRequest = (object) $input;
        return $this->purchaseSubmit($myRequest);
    }
    public function purchaseSubmit($request)
    {
        try {
            $input = (array) $request;
            $plan = PricingPlan::findOrFail($request->pricing_plan_id);
            if ($request->discount_code != null) {
                $coupon = self::couponQuickCheck($request->discount_code, $plan->price);
                if ($coupon) {
                    Coupon::where('id',$coupon->id)->update([
                        'used_qty' => $coupon->used_qty + 1
                    ]);
                    $input['discount'] = $coupon->discount;
                    $input['total_amount'] = $plan->price - $coupon->discount;
                }
            } else {
                $input['total_amount'] = $plan->price;
            }

            $input['credits'] = $plan->credits;
            $input['link_submit'] = $plan->link_submit;
           // return $input;
            $order = Order::create($input);
            // Coupon code used qty update
            if (isset($coupon)) {
                Coupon::where('id',$coupon->id)->update([
                    'used_qty' => $coupon->used_qty + 1
                ]);
            }
             // Balance update
            if($request->payment_method == 'aamarpay'){
                $user = User::findOrFail($request->user_id);
                $user->update([
                    'credits_balance' => $user->credits_balance + $plan->credits,
                    'link_submit_balance' => $user->link_submit_balance + $plan->link_submit
                ]);
            }

            return redirect()->route('user.transections.show',$order->id)->with('success', 'Order submitted successfully');
        } catch (\Exception $e) {
            //return $e->getMessage();
            return back()->with('error', $e->getMessage());
        }
    }

    public function aamarpayProcess(Request $request)
    {
        $plan = PricingPlan::where('id', $request->plan)->firstOrFail();
        $phone = "018";
        //Price if discount or not
        if (isset($request->discount_code) && $request->discount_code != null) {
            $coupon = self::couponQuickCheck($request->discount_code, $plan->price);
            if ($coupon) {
                $price = $plan->price - $coupon->discount;
            }
        } else {
            $price = $plan->price;
        }
        $url = 'https://sandbox.aamarpay.com/';
        // $url = 'https://secure.aamarpay.com/';
        $fields = [
            'store_id' => readConfig('aamarpay_store_id'),
            'amount' => $price, //transaction amount
            'payment_type' => 'VISA', //no need to change
            'currency' => ($plan->currency == 'usd') ? 'USD' : 'BDT',  //currenct will be USD/BDT
            'tran_id' => time() . '-' . rand(10000, 99999), //transaction id must be unique from your end
            'cus_name' => Auth::user()->name,  //customer name
            'cus_email' => Auth::user()->email, //customer email address
            'cus_phone' => Auth::user()->phone ?? $phone, //customer email address
            'desc' => 'Payment for Link',
            'success_url' => route('aamarpay.success'), //your success route
            'fail_url' => route('aamarpay.fail'), //your fail route
            'cancel_url' =>  route('user.checkout', $plan->id), //your cancel url
            'opt_a' => $plan->id,  //optional paramter
            'opt_b' => Auth::user()->id,
            'opt_c' => $request->discount_code,
            'signature_key' => readConfig('aamarpay_key')
        ];

        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url . 'request.php');

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
        curl_close($ch);

        $this->redirect_to_merchant($url, $url_forward);
    }
    function redirect_to_merchant($mainUrl, $url)
    {

?>
        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <script type="text/javascript">
                function closethisasap() {
                    document.forms["redirectpost"].submit();
                }
            </script>
        </head>

        <body onLoad="closethisasap();">

            <form name="redirectpost" method="post" action="<?php echo $mainUrl . $url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
        </body>

        </html>
<?php
        exit;
    }
    // Aamar Pay success
    public function aamarpaySuccess(Request $request)
    {

        $myResponse = [
            'invoice_no' => $request->mer_txnid,
            'pricing_plan_id' => $request->opt_a,
            'payment_method' => 'aamarpay',
            'total_amount' => $request->amount,
            'trans_id' => $request->pg_txnid,
            'user_id' => $request->opt_b,
            'verified_by' => $request->opt_b,
            'is_paid' => 1,
            'discount_code' => $request->opt_c,
            'discount' => 0,
        ];
        $myResponse = (object) $myResponse;
        $user = User::findOrFail($request->opt_b);
        Auth::loginUsingId($user->id);
        return $this->purchaseSubmit($myResponse);
    }
    // Aamar Pay fail
    public function aamarpayFail(Request $request)
    {
        $user = User::findOrFail($request->opt_b);
        Auth::loginUsingId($user->id);
        return redirect()->route('user.checkout', $request->opt_a)->with('error', 'Payment unsuccessful. Please try again later.');
    }

    public function couponValidation(Request $request)
    {
        $code = $request->code ?? '';
        $price = $request->price ?? 0;
        $coupon = Coupon::where('coupon_code', $code)
            ->where('status', 1)
            ->whereDate('start_date', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', date('Y-m-d'));
            })->first();
        if ($price == 0) {
            return response()->json('Total amount 0', 403);
        }
        if ($coupon == '') {
            return response()->json('Coupon not found', 404);
        } else {
            if ($coupon->qty != null && ($coupon->qty <= $coupon->used_qty)) {
                return response()->json('Coupon limit finished.', 403);
            }
            // check min purchase
            if ($coupon->min_purchase != '' && $coupon->min_purchase > $price) {
                return response()->json('Minimum purchase amount: ' . $coupon->min_purchase, 403);
            }
            if ($coupon->type == 1) {
                $discount = $coupon->discount_value;
            } else {
                $discount = number_format(($price / 100) * $coupon->discount_value, 2, ".", "");
                if ($coupon->max_discount != '' && $coupon->max_discount < $discount) {
                    $discount = $coupon->max_discount;
                }
            }
            $coupon->discount = $discount;

            return response()->json($coupon, 200);
        }
    }
    public static function couponQuickCheck($code, $price)
    {
        $coupon = Coupon::where('coupon_code', $code)
            ->where('status', 1)
            ->whereDate('start_date', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', date('Y-m-d'));
            })->first();
        if ($price == 0) {
            return false;
        }
        if ($coupon == '') {
            return false;
        } else {
            if ($coupon->qty != null && ($coupon->qty <= $coupon->used_qty)) {
                return false;
            }
            // check min purchase
            if ($coupon->min_purchase != '' && $coupon->min_purchase > $price) {
                return false;
            }
            if ($coupon->type == 1) {
                $discount = $coupon->discount_value;
            } else {
                $discount = number_format(($price / 100) * $coupon->discount_value, 2);
                if ($coupon->max_discount != '' && $coupon->max_discount < $discount) {
                    $discount = $coupon->max_discount;
                }
            }
            $coupon->discount = $discount;

            return $coupon;
        }
    }

    public function transections(Request $request)
    {
        if ($request->ajax()) {
            $allData = Order::with('plan')->where('user_id',auth()->user()->id)->latest();
    
            return DataTables::of($allData)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex','')
                ->addColumn('plan_name',function($data){
                    return $data->plan->title;
                })
                ->addColumn('amount',function($data){
                    return ($data->plan->currency == 'usd' ? '$' : '৳') . $data->total_amount;
                })
                ->editColumn('status', function ($data) {
                    if($data->is_paid == 1){
                        return "<span class='badge bg-success'>Success</span>";
                    }else{
                        return "<span class='badge bg-warning'>Pending</span>";
                    }
                })
                ->addColumn('created', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn(
                    'action',
                    '<div class="action-wrapper">
                    <a class="btn btn-xs bg-gradient-success"
                        href="{{ route(\'user.transections.show\', $id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                        
                    </div>'
                )
                ->rawColumns(['status', 'created', 'action'])
                ->toJson();
        }
        
        return view('backend.purchase.transections');
    }

    public function transectionsDetails($id){
        $data = Order::where(['id'=>$id,'user_id'=>auth()->user()->id])->firstOrFail();
        return view('backend.purchase.transectionDetails',compact('data'));
    }





}
