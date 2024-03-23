@extends('admin.layouts.master')
@section('page-title')
{{ __('general.experts') }}
@endsection
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

<link href="{{URL::asset('assets/css/admin/content.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"><a href="{{ route('expert.index') }}">{{ __('general.experts') }}</a></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
								<h4 class="card-title mb-1">{{ __('general.expert info') }}</h4>
								<p class="mb-2"> </p>
							</div>
							<div class="card-body row  pt-0">
								<div class="col-lg-8">
								<form class="form-horizontal" name="create_form" action="{{route('expert.update', $expert->id)}}" method="POST" enctype="multipart/form-data" id="create_form">
									@csrf
									<div class="form-group">
										<input type="text" class="form-control " id="first_name" placeholder="{{ __('general.first_name') }}" name="first_name" value="{{ $expert->first_name}}">
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="first_name_error"></li>
										</ul>
										 
									</div>

                                    <div class="form-group">
										<input type="text" class="form-control" id="last_name" placeholder="{{ __('general.last_name') }}" name="last_name" value="{{ $expert->last_name }}">
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="last_name_error"></li>
										</ul>
									</div>
									<div class="form-group">
										<input type="email" class="form-control" id="email" placeholder="{{ __('general.email') }}" name="email" value="{{ $expert->email }}">
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="email_error"></li>
										</ul>
									</div>
                                    <div class="form-group">
										<input type="text" class="form-control" id="user_name" placeholder="{{ __('general.user_name') }}" name="user_name" value="{{ $expert->user_name }}">
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="user_name_error"></li>
										</ul>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" id="password" placeholder="{{ __('general.password') }}" name="password">
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="password_error"></li>
										</ul>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" id="confirm_password" placeholder="{{ __('general.confirm_password') }}" name="confirm_password">
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="confirm_password_error"></li>
										</ul>
									</div>

									<div class="input-group mb-4"  id="mobile_num" >
									 
										<div class="input-group-prepend" style="padding-right: 1px; padding-left: 4px;">
											<div  >
												<select name="country_num"   id="country_sel" class="form-control SlectBox"  >
													<!--placeholder-->
													<option title="" value="0"  class="text-muted">اختر رمز الدولة</option>
												 
												</select>
											</div>
										</div>
										<input type="text" class="form-control mobile" id="mobile_2" value="{{ $expert->mobile_num }}" placeholder="{{ __('general.mobile') }}" name="mobile_num">
									
									</div>
									<ul class="parsley-errors-list filled" >
										<li class="parsley-required" id="mobile_num_error"></li>
									</ul>
									<ul class="parsley-errors-list filled" >
										<li class="parsley-required" id="country_num_error"></li>
									</ul>
                                    <div class="mb-4">
                                        <select name="gender"   id="gender" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                            <!--placeholder-->
                                            <option title=""   class="text-muted">{{ __('general.gender') }}</option>
                                            <option value="1"  @if ( $expert->gender=='1')selected="selected" @endif>{{ __('general.male') }}</option>
                                            <option value="2"  @if ( $expert->gender=='2')selected="selected" @endif>{{ __('general.female') }}</option>
                                        </select>
										<ul class="parsley-errors-list filled">
											<li class="parsley-required"  id="gender_error"></li>
										</ul>
                                    </div>

 
                                    <div class="input-group"  id="birthdate" >
									 
										<div class="input-group-prepend" style="padding-right: 1px;">
											<div class="input-group-text">
												<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>{{ __('general.birthdate') }}
											</div>
										</div><input class="form-control  fc-datepicker" name="birthdate" id='expertdate'   placeholder="MM/DD/YYYY" type="text"  value="{{ $expert->birthdateStr }}" >
	
									</div>
							 
									<ul class="parsley-errors-list filled" >
										<li class="parsley-required" id="birthdate_error"></li>
									</ul>
								
                                    <div class="my-4">
										<textarea class="form-control" placeholder="{{ __('general.descreption') }}" rows="3" id="desc" name="desc">{{$expert->desc}}</textarea>
									</div>
                                    <div class="form-group mb-4 justify-content-end">
										<div class="custom-file">
											<input class="custom-file-input" id="image" name="image" type="file"> <label class="custom-file-label" for="customFile"  id="image_label">{{ __('general.choose image') }}</label>
											<ul class="parsley-errors-list filled" >
												<li class="parsley-required" id="image_error"></li>
											</ul>
										</div>
									</div>
									<div class="form-group justify-content-end">
										<div class="checkbox">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" data-checkboxes="mygroup" @if ( $expert->is_active=='1') @checked(true) @endif  class="custom-control-input" id="is_active" value="{{ $expert->is_active }}" name="is_active">
												<label id="lbl_is_active" for="is_active" class="custom-control-label mt-1"  >{{ __('general.is_active') }}</label>
											</div>
											
										</div>
										<ul class="parsley-errors-list filled" >
											<li class="parsley-required" id="is_active_error"></li>
										</ul>
									</div>
									<div class="form-group mb-0 mt-3 justify-content-end">
										<div>
											<button type="submit" name="btn_update_user" id="btn_update_user" class="btn btn-primary">{{ __('general.save') }}</button>
											<button type="button" name="btn_cancel" id="btn_cancel"  class="btn btn-secondary">{{ __('general.cancel') }}</button>				
										</div>
									</div>
								</form>
							</div>
							<div class="col-lg-4 mt-sm-3 mt-lg-0">
								<img alt="" id="imgshow" class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
								src="@if($expert->image==""){{URL::asset('assets/img/photos/1.jpg')}}@else {{ $expert->fullpathimg }} @endif" >
												 
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
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>

<script src="{{URL::asset('assets/js/admin/validate.js')}}"></script>
<script src="{{URL::asset('assets/js/admin/content.js')}}"></script>
<script src="{{URL::asset('assets/js/admin/country.js')}}"></script>
<script src="{{URL::asset('assets/js/admin/focus.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script  >  
var emptyimg ="{{URL::asset('assets/img/photos/1.jpg')}}";
 
     $('#expertdate').datepicker( "option", "altFormat", "yy-mm-dd" );
	 var countryurl = "{{URL::asset('assets/js/admin/countries.json')}}";
	 var selcntry = "{{$expert->country_num}}";
 </script>
@endsection
