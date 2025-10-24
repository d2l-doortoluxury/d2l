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
                        {{ __('Edit User') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-10 col-lg-12">
                    <form action="{{ route('admin.update.user') }}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <h4 class="page-title">{{ __('User Details') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="user_id"
                                            placeholder="{{ __('User ID') }}..." value="{{ $user_details->user_id }}"
                                            readonly>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Full Name') }}</label>
                                                <input type="text" class="form-control" name="full_name"
                                                    placeholder="{{ __('Full Name') }}..."
                                                    value="{{ $user_details->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Email') }} </label>
                                                <input type="text" class="form-control" name="email"
                                                    placeholder="{{ __('Email') }}..."
                                                    value="{{ $user_details->email }}" required>
                                            </div>
                                        </div>
                                        <h2 class="page-title my-3">
                                            {{ __('Change Password') }}
                                        </h2>
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('New Password') }} </label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="{{ __('New Password') }}...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection