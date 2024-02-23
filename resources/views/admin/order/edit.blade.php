@extends('admin.layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('assets/css/admin/content.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/simple-lightbox.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{ route('order.index') }}">{{ __('general.orders') }}</a>
                </h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col">
            <div class="card  box-shadow-0">
                <div class="card-header mb-2">
                    <h3 class="card-title mb-1">{{ __('general.order details') }}</h3>
                </div>
                <div class="card-body pt-0">


                    <p><span class="badge badge-light badge-lg px-3 py-2"><img alt="User Icon SVG Vector Icon"
                                fetchpriority="high" decoding="async" data-nimg="1" style="width:20px;height:20px"
                                src="{{$selectedservice->service->svg_path }}">
                            {{ ' ' . __('general.service') }}</span>{{ ' ' . $selectedservice->service->name }}</p>
                    <p><span class="badge badge-light px-3 py-2"><img alt="User Icon SVG Vector Icon" fetchpriority="high"
                                decoding="async" data-nimg="1" style="width:20px;height:20px"
                                src="{{ asset('storage/images/inputs/icons/username.svg') }}">
                            {{ ' ' . __('general.expert') }}</span>{{ ' ' . $selectedservice->expert->full_name }}</p>
                  
                            @foreach ($selectedservice->valueServices->whereNotIn('type', ['image', 'record']) as $valueService)
                        <p><span class="badge badge-light badge-lg px-3 py-2"><img fetchpriority="high" decoding="async"
                                    data-nimg="1" style="color:white;width:20px;height:20px"
                                    src="{{ $valueService->svg_path }}">
                                {{ ' ' . $valueService->tooltipe }}</span>{{ ' ' . $valueService->value_conv }}</p>
                    @endforeach
                    <div class="gallery">
                        @foreach ($selectedservice->valueServices->where('type', 'image') as $valueService)
                        <a href="{{ $valueService->full_path_conv }}" class="big" rel="rel1">
                            <img src="{{ $valueService->full_path_conv }}" alt="" title="">
                        </a>
                        @endforeach
                    </div>
                        <div class="bd pd-20 clearfix">
                            @foreach ($selectedservice->valueServices->where('type', 'image') as $valueService)
                            <img alt="" id="imgshow"
                                class="rounded float-sm-right wd-100p wd-sm-200 ml-3"
                                src="{{ $valueService->full_path_conv }}">
                            @endforeach
                        </div>
                    @foreach ($selectedservice->valueServices->where('type', 'record') as $valueService)
                        <label class="col-sm-12 ">تسجيل صوتي</label>
                        <audio controls class="col-sm-12 ">
                            <source src="{{ $valueService->full_path_conv }}" type="audio/mpeg">
                        </audio>
                    @endforeach
                    @if ($selectedservice->form_state == 'wait')
                        <form class="form-horizontal" name="create_form"
                            action="{{ route('order.update', $selectedservice->id) }}" method="POST" id="update_form">
                            @csrf

                            <div class="mb-4">
                                <select name="form_state" id="form_state" class="form-control  ">
                                    <!--placeholder-->
                                    <option title="" class="text-muted">{{ __('general.status.wait') }}</option>
                                    <option value="agree">{{ __('general.status.agree') }}</option>
                                    <option value="reject">{{ __('general.status.reject') }}</option>
                                </select>
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required" id="form_state_error"></li>
                                </ul>
                            </div>
                            <div class="mb-4" id="reason-div" style="display: none;">
                                <select name="form_reject_reason" id="form_reject_reason" class="form-control  ">
                                    <!--placeholder-->
                                    <option title="" class="text-muted">اختر سبب الرفض</option>
                                    @foreach ($reasons as $reason)
                                        <option value="{{ $reason->id }}">{{ $reason->content }}</option>
                                    @endforeach

                                </select>
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required" id="form_reject_reason_error"></li>
                                </ul>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" name="btn_update_state" id="btn_update_state"
                                        class="btn btn-primary">{{ __('general.save') }}</button>
                                    <button type="button" name="btn_cancel" id="btn_cancel"
                                        class="btn btn-secondary">{{ __('general.cancel') }}</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <label
                            class="col-sm-12 ">{{ __('general.status') }}:{{ ' ' . $selectedservice->form_state_conv }}</label>
                        @if ($selectedservice->form_state == 'reject')
                            <label class="col-sm-12 ">سبب الرفض:{{ ' ' . $selectedservice->form_reject_reason }}</label>
                        @endif
                    @endif

                    {{--
								<div class="pd-20 clearfix">
									<img alt="" id="imgshow" class="rounded img-thumbnail wd-100p wd-sm-200 float-sm-right  mg-t-10 mg-sm-t-0"
                                    src="@if ($selectedservice->image == ''){{URL::asset('assets/img/photos/1.jpg')}}@else {{ $selectedservice->fullpathimg }} @endif" >
								</div>
                                 --}}
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script src="{{ URL::asset('assets/js/admin/validate.js') }}"></script>
    <script src="{{ URL::asset('assets/js/admin/order.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/simple-lightbox.js') }}"></script>
    <!-- For legacy browsers -->
    <script src="{{ URL::asset('assets/js/simple-lightbox.legacy.min.js') }}"></script>
    <!-- As A jQuery Plugin -->
    <script src="{{ URL::asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/simple-lightbox.jquery.min.js') }}"></script>
    <script>
        var emptyimg = "{{ URL::asset('assets/img/photos/1.jpg') }}";

        $('#expertdate').datepicker("option", "altFormat", "yy-mm-dd");

        var lightbox = $('.gallery a').simpleLightbox({
            // default source attribute
            sourceAttr: 'href',

            // shows fullscreen overlay
            overlay: true,

            // shows loading spinner
            spinner: true,

            // shows navigation arrows
            nav: true,

            // text for navigation arrows
            navText: ['&larr;','&rarr;'],

            // shows image captions
            captions: true,
            captionDelay: 0,
            captionSelector: 'img',
            captionType: 'attr',
            captionPosition: 'bottom',
            captionClass: '',
            captionHTML: false,

            // captions attribute (title or data-title)
            captionsData: 'title',

            // shows close button
            close: true,

            // text for close button
            closeText: 'X',

            // swipe up or down to close gallery
            swipeClose: true,

            // show counter
            showCounter: true,

            // file extensions
            fileExt: 'png|jpg|jpeg|gif',

            // weather to slide in new photos or not, disable to fade
            animationSlide: true,

            // animation speed in ms
            animationSpeed: 250,

            // image preloading
            preloading: true,

            // keyboard navigation
            enableKeyboard: true,

            // endless looping
            loop:  true,

            // group images by rel attribute of link with same selector
            rel: false,

            // closes the lightbox when clicking outside
            docClose:  true,

            // how much pixel you have to swipe
            swipeTolerance: 50,

            // lightbox wrapper Class
            className: 'simple-lightbox',

            // width / height ratios
            widthRatio: 0.8,
            heightRatio: 0.9,

            // scales the image up to the defined ratio size
            scaleImageToRatio: false,

            // disable right click
            disableRightClick: false,

            // disable page scroll
            disable<a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>: true,

            // show an alert if image was not found
            alertError:  true,

            // alert message
            alertErrorMessage: 'Image not found, next image will be loaded',

            // additional HTML showing inside every image
            additionalHtml: false,

            // enable history back closes lightbox instead of reloading the page
            history: true,

            // time to wait between slides
            throttleInterval: 0,

            // Pinch to <a href="https://www.jqueryscript.net/zoom/">Zoom</a> feature for touch devices
            doubleTapZoom: 2,
            maxZoom: 10,

            // adds class to html element if lightbox is open
            htmlClass: 'has-lightbox',

            // RTL mode
            rtl: false,

            // elements with this class are fixed and get the right padding when lightbox opens
            fixedClass: 'sl-fixed',

            // fade speed in ms
            fadeSpeed: 300,

            // whether to uniqualize images
            uniqueImages: true,

            // focus the lightbox on open to enable tab control
            focus: true,
        });
    </script>
@endsection
