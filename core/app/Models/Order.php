<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plan(){
        return $this->belongsTo(PricingPlan::class,'pricing_plan_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function verifier(){
        return $this->belongsTo(User::class,'verified_by');
    }
}
