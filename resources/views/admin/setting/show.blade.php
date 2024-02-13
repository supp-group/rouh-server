@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row opened -->
        <div class="row row-sm">


            <!--div-->
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">نسبة الخبير الافتراضية</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <form class="form-horizontal" name="create_form" action="" method="POST"
                                enctype="multipart/form-data" id="create_form">
                                @csrf
                                <div class="form-group d-flex justify-content-between">
                                    <input type="text" class="form-control " id="name" placeholder="نسبة الخبير"
                                        name="name" value="">
                                    <button type="submit" name="btn_update_user" id="btn_update_user"
                                        class="btn btn-primary mr-3">{{ __('general.save') }}</button>
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required" id="name_error"></li>
                                    </ul>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--/div-->


            </div>
            <!-- /div-->

            <!--div-->
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">النقاط الافتراضية</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <form class="form-horizontal" name="create_form" action="" method="POST"
                                enctype="multipart/form-data" id="create_form">
                                @csrf
                                <div class="form-group d-flex justify-content-between">
                                    <input type="text" class="form-control " id="name" placeholder="نقاط الخدمة"
                                        name="name" value="">
                                    <button type="submit" name="btn_update_user" id="btn_update_user"
                                        class="btn btn-primary mr-3">{{ __('general.save') }}</button>
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required" id="name_error"></li>
                                    </ul>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--/div-->


            </div>
            <!-- /div-->
        </div>
        <!-- row closed -->

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
