@extends('layouts.admin', ['header' => true, 'nav' => true, 'demo' => true])

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
                        {{ __('Users') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" id="table-plan">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Full Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Current Plan') }}</th>
                                        <th>{{ __('Joined') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th class="w-1">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><a href="{{ route('admin.view.user', $user->user_id)}}">{{ $user->name
                                                }}</a>
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="text-capitalize">
                                            <?php $plan_data = json_decode($user->plan_details,TRUE); ?>
                                            @if ($plan_data == null)
                                            {{ __('No Plan') }}
                                            @else
                                            <strong>{{ __($plan_data['plan_name']) }}
                                                <span>
                                                    @if ($plan_data['plan_price'] == '0')
                                                    ({{ __('Free') }})
                                                    @else
                                                    ({{ $config[1]->config_value }}
                                                    {{ $plan_data['plan_price'] }})
                                                    @endif
                                                </span>
                                                @endif
                                            </strong>
                                        </td>
                                        <td>
                                            {{ date('d-m-Y h:m A', strtotime($user->created_at)) }}
                                        </td>
                                        <td>
                                            @if ($user->status == 0)
                                            <span class="badge bg-red">{{ __('Inactive') }}</span>
                                            @else
                                            <span class="badge bg-green">{{ __('Active') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <button class="btn small-btn dropdown-toggle align-text-top"
                                                    data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                    aria-expanded="false">{{ __('Actions') }}</button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.edit.user', $user->user_id)}}">{{
                                                        __('Edit') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.change.user.plan', $user->user_id)}}">{{
                                                        __('Change Plan') }}</a>
                                                    @if ($user->status == 0)
                                                    <a href="#" class="dropdown-item"
                                                        onclick="getUser('{{ $user->user_id }}'); return false;">{{
                                                        __('Activate') }}</a>
                                                    @else
                                                    <a href="#" class="dropdown-item"
                                                        onclick="getUser('{{ $user->user_id }}'); return false;">{{
                                                        __('Deactivate') }}</a>
                                                    @endif
                                                    <a href="#" class="dropdown-item"
                                                        onclick="deleteUser('{{ $user->user_id }}'); return false;">{{
                                                        __('Delete') }}</a>
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
    @include('admin.includes.footer')
</div>

<div class="modal modal-blur fade" id="status-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure?')}}</div>
                <div>{{ __('If you proceed, you will active/deactivate this user data.')}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary me-auto" data-bs-dismiss="modal">{{
                    __('Cancel')}}</button>
                <a class="btn btn-danger" id="user_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title text-capitalize">{{ __('WARNING!')}}</div>
                <div>{{ __('This action will remove user account and user data. It is not revertable action.')}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary me-auto" data-bs-dismiss="modal">{{
                    __('Cancel')}}</button>
                <a class="btn btn-danger" id="deleted_user_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection