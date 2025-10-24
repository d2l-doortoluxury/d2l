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
                        {{ __('Add Plan') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-12 col-lg-12">
                    <form action="{{ route('admin.save.plan') }}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <h4 class="page-title">{{ __('Plan Details') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        {{-- Plan Name --}}
                                        <div class="col-md-6 col-xl-3">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Plan Name') }}</label>
                                                <input type="text" class="form-control" name="plan_name"
                                                    placeholder="{{ __('Plan Name') }}..." required>
                                            </div>
                                        </div>
                                        {{-- Description --}}
                                        <div class="col-md-6 col-xl-3">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Description') }}</label>
                                                <input type="text" class="form-control" name="plan_description"
                                                    placeholder="{{ __('Description') }}..." required>

                                            </div>
                                        </div>
                                        <h2 class="page-title my-3">
                                            {{ __('Plan Prices') }}
                                        </h2>
                                        <div class="col-md-6 col-xl-3">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Price') }}</label>
                                                <input type="number" class="form-control" name="plan_price" min="0"
                                                    step="0.01" placeholder="{{ __('Price') }}..." required>
                                                <small class="text-muted">{{ __('For free, enter 0') }} </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-xl-3">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Validity') }}</label>
                                                <input type="number" class="form-control" name="validity" min="1"
                                                    max="9999" placeholder="{{ __('Validity') }}..."
                                                    value="{{ $config[8]->config_value == 'monthly' ? 31 : 365 }}"
                                                    required>
                                                <small class="text-muted">{{ __('For forever, enter 9999') }} </small>
                                            </div>
                                        </div>

                                        <h2 class="page-title my-3">
                                            {{ __('Plan Features') }}
                                        </h2>
                                        <div class="col-md-4 col-xl-2">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('No. of vCards') }}</label>
                                                <input type="number" class="form-control" name="no_of_vcards" min="1"
                                                    max="999" placeholder="{{ __('No. of vCards') }}..." value="1"
                                                    required>
                                                <small class="text-muted">{{ __('For unlimited, enter 999') }} </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-2">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('No. of Services/Products')
                                                    }}</label>
                                                <input type="number" class="form-control" name="no_of_services" min="1"
                                                    max="999" placeholder="{{ __('No. of Services/Products') }}..."
                                                    value="1" required>
                                                <small class="text-muted">{{ __('For unlimited, enter 999') }} </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xl-2">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('No. of Galleries') }}</label>
                                                <input type="number" class="form-control" name="no_of_galleries" min="1"
                                                    max="999" placeholder="{{ __('No. of Galleries') }}..." value="1"
                                                    required>
                                                <small class="text-muted">{{ __('For unlimited, enter 999') }} </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('No. of Card Features')
                                                    }}</label>
                                                <input type="number" class="form-control" name="no_of_features" min="1"
                                                    max="999" placeholder="{{ __('No. of Card Features') }}..."
                                                    value="1" required>
                                                <small class="text-muted">{{ __('For unlimited, enter 999') }} </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('No. of Payment Listed')
                                                    }}</label>
                                                <input type="number" class="form-control" name="no_of_payments" min="1"
                                                    max="999" placeholder="{{ __('No. of Payment Listed') }}..."
                                                    value="1" required>
                                                <small class="text-muted">{{ __('For unlimited, enter 999') }} </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Personalized Link') }}</div>
                                                <select class="form-select" name="personalized_link">
                                                    <option value="on">{{ __('Yes') }}</option>
                                                    <option value="off">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Hide Branding') }}</div>
                                                <select class="form-select" name="hide_branding">
                                                    <option value="on">{{ __('Yes') }}</option>
                                                    <option value="off">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Free Setup') }}</div>
                                                <select class="form-select" name="free_setup">
                                                    <option value="on">{{ __('Yes') }}</option>
                                                    <option value="off">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Free Support') }}</div>
                                                <select class="form-select" name="free_support">
                                                    <option value="on">{{ __('Yes') }}</option>
                                                    <option value="off">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- Recommended --}}
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Recommended Plan') }}</div>
                                                <select class="form-select" name="recommended">
                                                    <option value="on">{{ __('Yes') }}</option>
                                                    <option value="off">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- Private Plan --}}
                                        <div class="col-md-6 col-xl-2">
                                            <div class="mb-3">
                                                <div class="form-label">{{ __('Private Plan') }}</div>
                                                <select class="form-select" name="is_private">
                                                    <option value="on">{{ __('Yes') }}</option>
                                                    <option value="off">{{ __('No') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection