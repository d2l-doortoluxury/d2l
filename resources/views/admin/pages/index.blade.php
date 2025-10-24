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
                        {{ __('Pages') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            {{-- Failed --}}
            @if (Session::has("failed"))
            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon icon icon-tabler icon-tabler-alert-circle"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        {{Session::get('failed')}}
                    </div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            @endif

            {{-- Success --}}
            @if(Session::has("success"))
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon icon icon-tabler icon-tabler-check"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                    <div>
                        {{Session::get('success')}}
                    </div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            @endif

            <div class="row row-deck row-cards">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Static Pages') }}
                    </h2>
                </div>
                <span class="text-muted font-weight-bold">{{ __("Note: Static pages are doesn't have HTML editor. You
                    can able to change the contents only.")}}</span>

                {{-- Static Pages --}}
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" id="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Page') }}</th>
                                        <th>{{ __('Slug') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th class="w-1">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if ($page[0]->page_name == "home")
                                        <td>{{ __('Home') }}</td>
                                        @elseif ($page[0]->page_name == "about")
                                        <td>{{ __('About Us') }}</td>
                                        @elseif($page[0]->page_name == "contact")
                                        <td>{{ __('Contact Us') }}</td>
                                        @elseif($page[0]->page_name == "privacy")
                                        <td>{{ __('Privacy Policy') }}</td>
                                        @elseif($page[0]->page_name == "refund")
                                        <td>{{ __('Refund Policy') }}</td>
                                        @elseif($page[0]->page_name == "terms")
                                        <td>{{ __('Terms & Conditions') }}</td>
                                        @else
                                        <td class="text-uppercase">{{ $page[0]->page_name }}</td>
                                        @endif

                                        @if ($page[0]->page_name == "home")
                                        <td><a href="{{ env('APP_URL') }}" target="_blank">{{ '/' }}</a></td>
                                        @elseif ($page[0]->page_name == "about")
                                        <td><a href="{{ env('APP_URL') }}/about-us" target="_blank">{{ '/about-us'
                                                }}</a></td>
                                        @elseif($page[0]->page_name == "contact")
                                        <td><a href="{{ env('APP_URL') }}/contact-us" target="_blank">{{ '/contact-us'
                                                }}</a></td>
                                        @elseif($page[0]->page_name == "privacy")
                                        <td><a href="{{ env('APP_URL') }}/privacy-policy" target="_blank">{{
                                                '/privacy-policy' }}</a></td>
                                        @elseif($page[0]->page_name == "refund")
                                        <td><a href="{{ env('APP_URL') }}/refund-policy" target="_blank">{{
                                                '/refund-policy' }}</a></td>
                                        @elseif($page[0]->page_name == "terms")
                                        <td><a href="{{ env('APP_URL') }}/terms-and-conditions" target="_blank">{{
                                                '/terms-and-conditions' }}</a></td>
                                        @else
                                        <td><a href="{{ env('APP_URL') }}{{ '/'.$page[0]->page_name }}"
                                                target="_blank">{{ '/'.$page[0]->page_name }}</a></td>
                                        @endif
                                        <td>
                                            @if ($page[0]->status == 'active')
                                            <span class="badge bg-green">{{ __('Enabled') }}</span>
                                            @else
                                            <span class="badge bg-red">{{ __('Disabled') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <button class="btn small-btn dropdown-toggle align-text-top"
                                                    data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                    aria-expanded="false">{{ __('Actions') }}</button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.edit.page', $page[0]->page_name)}}">{{
                                                        __('Edit')
                                                        }}</a>
                                                    @if ($page[0]->status == 'inactive')
                                                    <a class="dropdown-item" href="#"
                                                        onclick="getDisablePage('{{ $page[0]->page_name }}'); return false;">{{
                                                        __('Enable') }}</a>
                                                    @else
                                                    @if ($page[0]->page_name != 'home' && $page[0]->page_name !=
                                                    'footer')
                                                    <a class="dropdown-item" href="#"
                                                        onclick="getDisablePage('{{ $page[0]->page_name }}'); return false;">{{
                                                        __('Disable') }}</a>
                                                    @endif
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

                {{-- Custom Pages --}}
                <div class="col mt-4">
                    <h2 class="page-title">
                        {{ __('Custom Pages') }}
                    </h2>
                </div>
                <!-- Add page -->
                <div class="col-auto ms-auto d-print-none mt-4">
                    <a type="button" href="{{ route('admin.add.page') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        {{ __('Add New Page') }}
                    </a>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" id="table1">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Page') }}</th>
                                        <th>{{ __('Slug') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th class="w-1">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($custom_pages as $page)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-capitalize">{{ $page->section_name }}</td>
                                        <td><a href="{{ env('APP_URL') }}{{ '/p/'.$page->section_title }}"
                                                target="_blank">{{ '/'.$page->section_title }}</a></td>
                                        <td>
                                            @if ($page->status == 'active')
                                            <span class="badge bg-green">{{ __('Enabled') }}</span>
                                            @else
                                            <span class="badge bg-red">{{ __('Disabled') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                    data-bs-boundary="viewport" data-bs-toggle="dropdown"
                                                    aria-expanded="false">{{ __('Actions') }}</button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.edit.custom.page', $page->id)}}">{{
                                                        __('Edit')
                                                        }}</a>
                                                    @if ($page->status == 'inactive')
                                                    <a class="dropdown-item" href="#"
                                                        onclick="getPage('{{ $page->id }}'); return false;">{{
                                                        __('Enable') }}</a>
                                                    @else
                                                    <a class="dropdown-item" href="#"
                                                        onclick="getPage('{{ $page->id }}'); return false;">{{
                                                        __('Disable') }}</a>
                                                    @endif
                                                    <a class="dropdown-item" href="#"
                                                        onclick="deletePage('{{ $page->id }}', 'delete'); return false;">{{
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

    {{-- Footer --}}
    @include('admin.includes.footer')
</div>

{{-- Enable/Disable Page Modal --}}
<div class="modal modal-blur fade" id="status-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure?')}}</div>
                <div>{{ __('If you proceed, you will enable/disable this page.')}}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary me-auto" data-bs-dismiss="modal">{{
                    __('Cancel')}}</button>
                <a class="btn btn-danger" id="page_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>

{{-- Delete Page Modal --}}
<div class="modal modal-blur fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">{{ __('Are you sure?')}}</div>
                <div id="delete_status"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary me-auto" data-bs-dismiss="modal">{{
                    __('Cancel')}}</button>
                <a class="btn btn-danger" id="delete_qr_code_id">{{ __('Yes, proceed')}}</a>
            </div>
        </div>
    </div>
</div>

{{-- Custom JS --}}
@section('scripts')
<script>
    (function ($) {
    "use strict";
        $('#table1').DataTable();
})(jQuery);
function getPage(parameter) {
    "use strict";
    $("#status-modal").modal("show");
    var link = document.getElementById("page_id");
    link.getAttribute("href");
    link.setAttribute("href", "{{ route('admin.status.page') }}?id=" + parameter);
}
// Disable page
function getDisablePage(parameter) {
    "use strict";
    $("#status-modal").modal("show");
    var link = document.getElementById("page_id");
    link.getAttribute("href");
    link.setAttribute("href", "{{ route('admin.disable.page') }}?id=" + parameter);
}
// Delete QR
function deletePage(deletePageId, deletePageStatus) {
    "use strict";
    $("#delete-modal").modal("show");
    var delete_status = document.getElementById("delete_status");
    delete_status.innerHTML = "<?php echo __('If you proceed, you will') ?> " + deletePageStatus + " <?php echo __('this page.') ?>"
    var delete_link = document.getElementById("delete_qr_code_id");
    delete_link.getAttribute("href");
    delete_link.setAttribute("href", "{{ route('admin.delete.page') }}?id=" + deletePageId);
}
</script>
@endsection
@endsection