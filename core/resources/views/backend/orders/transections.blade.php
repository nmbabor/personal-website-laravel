@extends('backend.master')

@section('title', 'Transections')
@section('title_button')
<a href="{{ route('user.pricing-plans') }}" class="btn bg-gradient-primary" >
    <i class="fas fa-plus"></i>
     Purchase
</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <table id="datatables" class="table table-hover">
                <thead>
                    <tr>
                        <th data-orderable="false">#</th>
                        <th>Invoice</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>User Email</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th data-orderable="false">
                            Action
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            let table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                order: [
                    [1, 'asc']
                ],
                ajax: {
                    url: "{{ route('admin.transections') }}"
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }
                    , {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'plan_name',
                        name: 'plan.title',
                    },
                    {
                        data: 'amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'user_email',
                        name: 'user.email'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'status',
                        name: 'is_paid'
                    },
                    {
                        data: 'created',
                        name: 'created_at',
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endpush