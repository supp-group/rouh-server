@extends('admin.layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/admin/content.css') }}" rel="stylesheet">

    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"><a
                        href="{{ route('service.index') }}">{{ __('general.services') }}</a></h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('general.edit') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h6 class="card-title">قائمة خبراء خدمة {{ $service->name }}</h6>
                        <a class="btn ripple btn-light" data-target="#scrollmodal" data-toggle="modal" id="btn_show_expertmodal"><i class="fa fa-plus"></i> إضافة خبير</a>
                    </div>
                 
                    <div id="div_selectedexpert">
                                    @foreach ($selectedexperts as $selectedexpert)
                                  
                                    <form class="form-horizontal delete-expert-form" name="delete_expert_form"
                                    action="{{ url('admin/service/expert/deleteselected', $selectedexpert->id) }}" method="POST"
                                    id="delete_expert_form">
                                    @csrf
                                    <div class="mb-2">
                                        <div class="mb-3">
                                            <div class="service-field row">
                                                <div class="col-8">
                                                    <p>{{ $selectedexpert->expert->user_name }}</p>
                                                </div>           
            
                                                <div class="col-4">
                                                    <div class="form-horizontal d-inline-block">
                                                        <div class="form-group">
            
                                                            <button type="submit" class="btn ripple btn-danger btn-delete-expert"
                                                                id="expert-{{ $selectedexpert->expert->id }}"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
            
            
                                            </div>
            
                                        </div>
            
                                    </div>
                                </form>
@endforeach
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





    <!-- Scroll with content modal -->
    <div class="modal" id="scrollmodal">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">إضافة خبير</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- row -->
                    <div class="row row-sm">
                        <div class="col">
                            <div class="card  box-shadow-0">
                                <div class="card-body pt-4">
                                    <form class="form-horizontal" name="expert_form"
                                        action="{{ url('admin/service/expert/save', $service->id) }}" method="POST"
                                        id="expert_form">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <select name="select_expert" id="select_expert" class="form-control SlectBox">
                                                <!--placeholder-->
                                                <option title="" selected class="text-muted">الخبير</option>
                                                 @foreach ($allexperts as $expert) 
                                                <option value="{{$expert->id}}">{{$expert->user_name}}</option>  
                                                 @endforeach  
                                            </select>
                                            <ul class="parsley-errors-list filled">
                                                <li class="parsley-required" id="select_expert_error"></li>
                                            </ul>
                                        </div>
 
                                        <div class="form-group mb-4 justify-content-end">
                                            <div>
                                                <button type="submit" form="expert_form" name="btn_save_expert" id="btn_save_expert"
                                                    class="btn btn-light btn-block"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>


                        </div>
                    </div>
                    <!-- row -->
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" data-dismiss="modal"  name="btn_close_expert" id="btn_close_expert"
                        type="button">حفظ</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" name="btn_cancel_field"
                        id="btn_cancel_field" type="button"> إلغاء</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Scroll with content modal -->

    <!-- Scroll Edit with content modal -->
    <div class="modal" id="scrollmodal-edit">

    </div>
    <!--End Scroll with content modal -->
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
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script src="{{ URL::asset('assets/js/admin/validate.js') }}"></script>
    <script src="{{ URL::asset('assets/js/admin/content.js') }}"></script>
    <script src="{{ URL::asset('assets/js/admin/expert.js') }}"></script>
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  Datatable js -->
   
    <script>
        var emptyimg = "{{ URL::asset('assets/img/photos/1.jpg') }}"
    </script>
    <script>
        urlshowexpert = "{{ url('admin/service/expert/showselected', $service->id) }}";  
    </script>
@endsection
