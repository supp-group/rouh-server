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
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a href="{{ route('answer.index') }}">{{ __('general.answers') }}</a>
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
                <div class="card-header">
                    <h4 class="card-title mb-1">{{ __('general.order details') }}</h4>
                    <p class="mb-2"> </p>
                </div>
                <div class="card-body pt-0">

                    <label
                        class="col-sm-12 ">{{ __('general.service') }}:{{ ' ' . $selectedservice->service->name }}</label>
                    <label
                        class="col-sm-12">{{ __('general.expert') }}:{{ ' ' . $selectedservice->expert->full_name }}</label>
                    <label
                        class="col-sm-12 ">{{ __('general.client') }}:{{ ' ' . $selectedservice->client->user_name }}</label>
                    <label class="col-sm-12 ">الحقول: </label>

                    @foreach ($selectedservice->valueServices->whereNotIn('type', ['image', 'record']) as $valueService)
                        <label class="col-sm-12 ">
                            <p>{{ $valueService->tooltipe }}</p>
                            <p>{{ $valueService->value_conv }}</p>
                        </label>
                    @endforeach

                    @foreach ($selectedservice->valueServices->where('type', 'image') as $valueService)
                        <div class="pd-20 clearfix">
                            <img alt="" id="imgshow"
                                class="rounded img-thumbnail wd-100p wd-sm-200 float-sm-right  mg-t-10 mg-sm-t-0"
                                src="{{ $valueService->full_path_conv }}">
                        </div>
                    @endforeach
                    @foreach ($selectedservice->valueServices->where('type', 'record') as $valueService)
                        <label class="col-sm-12 ">تسجيل صوتي</label>
                        <audio controls class="col-sm-12 ">
                            <source src="{{ $valueService->full_path_conv }}" type="audio/mpeg">
                        </audio>
                    @endforeach

                    <label class="col-sm-12 "> {{ __('general.answer') }}</label>
                    @if ($selectedservice->answer_state != 'no_answer')
                        <label class="col-sm-12 ">{{ $selectedservice->answers->first()->content }}</label>
                        <audio controls class="col-sm-12 ">
                            <source src="{{ $selectedservice->answers->first()->record_path }}" type="audio/mpeg">
                        </audio>
                    @endif
                   
                    <label class="col-sm-12 "> {{ __('general.status') }}:  {{ $selectedservice->answer_state_conv }}</label>
                    @if ($selectedservice->answer_state != 'no_answer')
                    @if ($selectedservice->answer_state == 'wait')
                    <form class="form-horizontal" name="create_form"
                    action="{{ route('answer.update', $selectedservice->id) }}" method="POST" id="update_form">
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
                            <li class="parsley-required" id="form_state_error"></li>
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
                    class="col-sm-12 ">{{ __('general.status') }}:{{ ' ' . $selectedservice->answer_state_conv }}</label>
                @if ($selectedservice->answer_state == 'reject')
                    <label class="col-sm-12 ">سبب الرفض:{{ ' ' . $selectedservice->answers->first()->answer_reject_reason }}</label>
                @endif
            @endif

            @endif 
            <label class="col-sm-12 "> الردود السابقة</label>
            <div class="table-responsive">
                <table   class="table text-md-nowrap">
                    <thead>
                        <tr>

                            <th class="border-bottom-0">{{ __('general.answer') }}</th>
                            <th class="border-bottom-0">الرد الصوتي</th>
                            <th class="border-bottom-0">تاريخ الرد</th>
                            <th class="border-bottom-0">{{ __('general.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selectedservice->answers->whereNotIn('answer_state',['wait']) as $answer)
                        <tr>

                            <td>{{$answer->content}}</td>
                            <td> <audio controls >
                                <source src="{{ $answer->record_path }}" type="audio/mpeg">
                            </audio></td>
                            <td>{{ $answer->created_at}}</td>
                            <td>{{ $answer->answer_state_conv}}</td>                     

                        </tr>
                        @endforeach
                </tbody>
                </table>
            </div>
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
    <script>
        var emptyimg = "{{ URL::asset('assets/img/photos/1.jpg') }}";

        $('#expertdate').datepicker("option", "altFormat", "yy-mm-dd");
    </script>
@endsection
