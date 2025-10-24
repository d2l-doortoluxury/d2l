@extends('layouts.web', ['nav' => true, 'banner' => false, 'footer' => true, 'cookie' => true, 'setting' => true, 'title' => __($page->section_name) ])

@section('content')
{{-- Custom JS --}}
@section('css')
{{-- AdSense status --}}
@if ($settings->adsense_code != "DISABLE")
@if ($settings->adsense_code != "")
{{-- AdSense code --}}
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $settings->adsense_code }}"
    crossorigin="anonymous"></script>
@endif
@endif
@endsection

<section class="pt-24 pb-12 bg-white" style="background-image: url({{ asset('images/web/elements/pattern-white.svg') }}); background-position: center;">
    <div class="container px-4 mx-auto" data-aos="fade-up">
        {{-- Page content --}}
        @if (!empty($page->section_content))
        {!! __($page->section_content) !!}
        @endif
    </div>
</section>

@endsection