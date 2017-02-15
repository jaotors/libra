@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title add">Payment List</h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Borrower Name</th>
                            <th>OR Number</th>
                            <th>Date Paid</th>
                            <th>View Transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $paymentTotal = 0 ?>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{str_pad($payment->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{ $payment->user()->first()->first_name . ' ' . $payment->user()->first()->last_name }}</td>
                                <td>{{ $payment->or_number}}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <?php $paymentTotal += $payment->amount ?>
                                <td>
                                    <a class="view" href="/admin/return-history/{{ $payment->return_history_id }}"><span class="glyphicon glyphicon-eye"></span> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                Total Payments: {{$paymentTotal}}
            </div>
        </div>
    </div>
@endsection
