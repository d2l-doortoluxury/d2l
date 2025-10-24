@extends('layouts.admin', ['header' => true, 'nav' => true, 'demo' => true])

{{-- Custom CSS --}}
@section('css')
<script src="https://cdn.tiny.cloud/1/{{ $config[39]->config_value }}/tinymce/6/tinymce.min.js" referrerpolicy="origin">
</script>
@endsection

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
                        {{ __('Add Page') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            {{-- Error --}}
            <div class="alert alert-important alert-danger alert-dismissible d-none" role="alert" id="fillError">
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
                        {{ __('Fill the all the required fields') }}
                    </div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>

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
                {{-- Save page --}}
                <div class="col-sm-12 col-lg-12">
                    <form action="{{ route('admin.save.page') }}" method="post" enctype="multipart/form-data"
                        class="card" id="customPageForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">

                                        {{-- Name --}}
                                        <input type="hidden" class="form-control text-capitalize" name="name"
                                            value="Custom Page" value="{{ old('name') }}" placeholder="{{ __('Name') }}"
                                            required />

                                        {{-- Page Name --}}
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <div class="form-label required">{{ __('Page Name') }}</div>
                                                <input type="text" class="form-control text-capitalize" name="page_name"
                                                    id="page_name" value="{{ old('page_name') }}"
                                                    placeholder="{{ __('Page Name') }}" required />
                                            </div>
                                        </div>

                                        {{-- Slug --}}
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <div class="form-label required">{{ __('Slug') }}</div>
                                                <input type="text" class="form-control" name="slug" id="slug"
                                                    value="{{ old('slug') }}" placeholder="{{ __('Slug') }}" required />
                                            </div>
                                        </div>

                                        {{-- Body --}}
                                        <div class="col-md-12 col-xl-12">
                                            <div class="mb-3">
                                                <div class="form-label required">{{ __('Body') }}</div>
                                                <textarea name="body" id="body" cols="30" rows="5" class="form-control"
                                                    placeholder="{{ __('Body') }}">{{ old('body') }}</textarea>
                                            </div>
                                        </div>

                                        <h2 class="page-title mt-3 mb-3">
                                            {{ __('SEO Configurations') }}
                                        </h2>

                                        {{-- Title --}}
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Title')
                                                    }}</label>
                                                <textarea class="form-control text-capitalize" name="title" rows="2"
                                                    placeholder="{{ __('Title') }}"
                                                    required>{{ old('title') }}</textarea>
                                            </div>
                                        </div>

                                        {{-- Meta Description --}}
                                        <div class="col-md-6 col-xl-6">
                                            <div class="mb-3">
                                                <div class="form-label required">{{ __('Description') }}</div>
                                                <textarea name="description" id="description" rows="2"
                                                    class="form-control text-capitalize"
                                                    placeholder="{{ __('Description') }}"
                                                    required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        {{-- Meta Keywords --}}
                                        <div class="col-md-12 col-xl-12">
                                            <div class="mb-3">
                                                <div class="form-label required">{{ __('Keywords') }}</div>
                                                <textarea name="keywords" id="keywords" rows="3"
                                                    class="form-control text-capitalize"
                                                    placeholder="{{ __('Keywords') }}"
                                                    required>{{ old('keywords') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary btn-md ms-auto">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('admin.includes.footer')
</div>

{{-- Custom JS --}}
@section('scripts')
<script>
    // Convert slug
$('#page_name').on("change keyup paste click", function() {
    "use strict";
    var Text = $(this).val();
    Text = Text.toLowerCase();
    Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
    $('#slug').val(Text);
});

tinymce.init({
    selector: 'textarea#body',
    plugins: 'code preview importcss searchreplace autolink autosave save directionality visualblocks visualchars link charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount charmap quickbars emoticons',
    menubar: 'file edit view insert format tools',
    toolbar: 'code undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview save print | insertfile link anchor | ltr rtl',
    content_style: 'body { font-family:Times New Roman,Arial,sans-serif; font-size:16px }',
});

$('#customPageForm').on('submit', function(e) {
    "use strict";
    if($('#body').summernote('isEmpty')) {
        $('#fillError').attr("class", "alert alert-important alert-danger alert-dismissible");
        e.preventDefault();
    }
});
</script>
@endsection
@endsection