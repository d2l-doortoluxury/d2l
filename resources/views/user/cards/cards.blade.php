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
                        {{ __('Business Cards') }}
                    </h2>
                </div>
                @if (env('APP_TYPE') == 'VCARD')
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('user.create.card') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            {{ ('Create vCard') }}
                        </a>
                    </div>
                </div>
                @endif

                @if (env('APP_TYPE') == 'STORE')
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('user.create.store') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            {{ ('Create WhatsApp Store') }}
                        </a>
                    </div>
                </div>
                @endif

                @if (env('APP_TYPE') == 'BOTH')
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="dropdown">
                        <button type="button" class="btn btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            {{ __('Create') }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.create.card') }}">
                                {{ __('vCard') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('user.create.store') }}">
                                {{ __('WhatsApp Store') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" id="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Created At') }}</th>
                                        <th>{{ __('Business Name') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Validity Upto') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th class="w-1">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($business_cards as $business_card)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @php
                                        $time = strtotime($business_card->created_at);
                                        $newformat = date('Y-m-d h:i A',$time);
                                        @endphp
                                        <td>{{ $newformat }}</td>
                                        <td><strong>{{ $business_card->title }}</strong></td>
                                        <td>{{ $business_card->card_type == 'vcard' ? __('vCard') : __('WhatsApp Store')
                                            }}</td>
                                        <td>
                                            {{ date('d/M/Y', strtotime($business_card->plan_validity)) }}</td>
                                        <td>
                                            @if ($business_card->card_status == 'inactive')
                                            <span class="badge bg-red">{{ __('Inactive') }}</span @else <span
                                                class="badge bg-green">{{ __('Active') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top small-btn"
                                                    data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                    aria-expanded="false">{{ __('Actions') }}</button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item open-qr" data-id="{{ $business_card->card_url }}"
                                                        href="#openQR">{{
                                                        __('Scan') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.edit.card', $business_card->card_id)}}">{{
                                                        __('Edit') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.view.preview', $business_card->card_id)}}"
                                                        target="_blank">{{ __('Preview') }}</a>
                                                    <a class="dropdown-item" href="{{ URL::to('/')."/".$business_card->card_url }}"
                                                        target="_blank">{{ __('Live') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.visitors', $business_card->card_url)}}">{{
                                                        __('Visitors') }}</a>
                                                    {{-- Check card type --}}
                                                    @if ($business_card->card_type == "vcard")
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.enquiries', $business_card->card_id)}}">{{
                                                        __('Enquiries') }}</a>
                                                    @endif
                                                    @if ($business_card->card_status == 'activated')
                                                    <a class="open-model dropdown-item"
                                                        data-id="{{ $business_card->card_id }}" href="#openModel">{{
                                                        __('Disable') }}</a>
                                                    @else
                                                    <a class="open-model dropdown-item"
                                                        data-id="{{ $business_card->card_id }}" href="#openModel">{{
                                                        __('Enable') }}</a>
                                                    @endif
                                                </div>
                                            </span>
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
    </div>
    @include('user.includes.footer')
</div>

<div class="modal modal-blur fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure?')}}</div>
                <div>{{ __('If you proceed, you will enabled/disabled this card.')}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary me-auto" data-bs-dismiss="modal">{{
                    __('Cancel')}}</button>
                <a class="btn btn-danger" id="plan_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="openQR" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">{{ __('Scan Business Card / Store')}}</div>
            </div>
            <div class="modal-body text-center">
                <img id="cardURL">
            </div>
        </div>
    </div>
</div>
@endsection