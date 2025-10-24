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
                        {{ __('Enquiries') }}
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
                            <table class="table table-vcenter card-table" id="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Mobile Number') }}</th>
                                        <th>{{ __('Message') }}</th>
                                        <th class="w-1">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businessEnquries as $enquiry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $enquiry->created_at->diffForHumans() }}</td>
                                        <td class="text-capitalize">{{ $enquiry->name }}</td>
                                        <td><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></td>
                                        <td><a href="tel:{{ $enquiry->phone }}">{{ $enquiry->phone }}</a></td>
                                        <td class="text-capitalize">{{ $enquiry->message }}</td>
                                        <td class="text-end">
                                            <a class="btn btn-primary btn-sm small-btn"
                                                href="mailto:{{ $enquiry->email }}">{{ __('Reply') }}</a>
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


@push('custom-js')
<script>

</script>
@endpush
@endsection