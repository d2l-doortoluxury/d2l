@extends('layouts.user', ['header' => true, 'nav' => true, 'demo' => true, 'settings' => $settings])

@section('content')
<div class="page-wrapper">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Overview') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Transactions') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" id="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Transaction Date') }}</th>
                                    <th class="w-1">{{ __('Payment ID') }}</th>
                                    <th>{{ __('Trans ID') }}</th>
                                    <th>{{ __('Payment Mode') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y H:i:s A') }}</td>
                                    <td><span>{{ $transaction->gobiz_transaction_id }}</span></td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>
                                        {{ __($transaction->payment_gateway_name) }}
                                    </td>
                                    <td>
                                        @foreach ($currencies as $currency)
                                        @if ($transaction->transaction_currency == $currency->iso_code)
                                        {{ $currency->symbol }}{{ $transaction->transaction_amount }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($transaction->payment_status == 'SUCCESS')
                                        <span class="badge bg-green">{{ __('Paid') }}</span>
                                        @endif
                                        @if ($transaction->payment_status == 'FAILED')
                                        <span class="badge bg-red">{{ __('Failed') }}</span>
                                        @endif
                                        @if ($transaction->payment_status == 'PENDING')
                                        <span class="badge bg-yellow">{{ __('Pending') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if ($transaction->invoice_number > 0)
                                        <span class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top small-btn"
                                                data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                aria-expanded="false">{{ __('Actions') }}</button>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a class="dropdown-item"
                                                    href="{{ route('user.view.invoice', ['id' => $transaction->gobiz_transaction_id])}}">{{
                                                    __('Invoice') }}</a>
                                            </div>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.includes.footer')
</div>
@endsection