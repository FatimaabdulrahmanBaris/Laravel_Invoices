@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@section('title')
الاقسام
@stop
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if($errors->any())
<div class="alert alert-danger">
 <ul>
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
 </ul>
</div>
@endif
				<!-- row -->
				<div class="row">
                     @if(session()->has('Add'))
					 <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session()->get('Add')}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden>&times</span>
							</button>
					 </div>
                     @endif
					 @if(session()->has('Error'))
					 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{session()->get('Error')}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden>&times</span>
							</button>
					 </div>
                     @endif
					 @if(session()->has('edit'))
					 <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session()->get('edit')}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden>&times</span>
							</button>
					 </div>
                     @endif
					 @if(session()->has('delete'))
					 <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session()->get('edit')}}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden>&times</span>
							</button>
					 </div>
                     @endif
	           <!--div-->
	            <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
							<div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة قسم</a>
							</div>
				
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
											<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم القسم </th>
												<th class="border-bottom-0">الوصف</th>
												<th class="border-bottom-0"> العمليات</th>
										
											</tr>
										</thead>
										<tbody>
											@foreach($section_db as $section)
											<tr>
												<td>{{$section->id}}</td>
												<td>{{$section->section_name}}</td>
												<td>{{$section->description}}</td>
												<td>
													<a href="#modaldemo9" class="modal-effect btn btn-sm btn-info"   data-toggle="modal" 
													data-id="{{$section->id}}" data-section_name="{{$section->section_name}}"
													data-description="{{$section->description}}" >
											     	<i class="las la-pan"></i>
											       </a>
												   <a  class="modal-effect btn btn-sm btn-danger" 
												   data-id="{{$section->id}}" data-name="{{$section->section_name}}"
												    data-toggle="modal" href="#modaldemo5">
											     	<i class="las la-trash"></i>
											       </a>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- row closed -->
			

			</div>
			<!-- Container closed -->
				<!-- Modal effects اضافة قسم -->
				<!-- <div class="modal" id="modaldemo8">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form action="{{route('section.store')}}" method="post">
									{{csrf_field()}}
								<div class="form-group">
									<label for="exampleInputEmail">اسم القسم</label>
									<input type="text" name="section_name" id="section_name" class="form-control">
								</div>
								<div class="form-group">
									<label for="exampleFormControlTextarea1">ملاحظات</label>
									
										<textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn  btn-success" type="submit">تأكيد</button>
								<button class="btn  btn-secondary" data-dismiss="modal" type="button">Close</button>
							</div>
						</from>	
						</div>
					</div>
			    </div> -->
						<!-- تعديل القسم -->				
		<!-- Basic modal -->
		<div class="modal" id="modaldemo9">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
					<h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body1">
						<form action="section/update" method="post" autocomplete="off" >
							{{method_field('patch')}}
							{{csrf_field()}}
						
						<div class="form-group">
							<input type="hidden" name="id" id="id" value="">
							<label for="exampleInputEmail">اسم القسم</label>
							<input  id="section_name"  name="section_name" class="form-control" type="text">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">ملاحظات</label>
							
								<textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="submit">Save changes</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Basic modal -->
			<!-- Modal alert message -->
	
		<div class="modal" id="modaldemo5">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content tx-size-sm">
					<div class="modal-body tx-center pd-y-20 pd-x-20">
						<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
						
						<form action="section/destroy" method="post">
						{{method_field('delete')}}
							{{csrf_field()}}
						<h4 class="tx-danger mg-b-20">تحذير هل انت متاكد من حذف القسم</h4>
						<input type="hidden" name="id" id="id" value="">

						<input  id="section_name"  name="section_name" class="form-control" type="text">
						<br>
						<br>
						<button  class="btn ripple btn-danger pd-x-25"  type="submit">delete</button>
					
						</form>	
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal alert message -->
		</div>
		<!-- main-content closed -->

	
@endsection
@section('js')
<!-- Internal Data tables -->
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
	<!--Internal  Datatable js -->
	<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
	<!--Internal  Datepicker js -->
	<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
	<!-- Internal Select2 js-->
	<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
	<!-- Internal Modal js-->
	<script src="{{URL::asset('assets/js/modal.js')}}"></script>
	<script src="{{URL::asset('assets/js/fatima.js')}}"></script>

<script>
$('#modaldemo9').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id');
    var section_name = button.data('section_name');
    var description = button.data('description');
    var modal = $(this)
    modal.find('.modal-body1 #id').val(id);
    modal.find('.modal-body1 #section_name').val(section_name);
    modal.find('.modal-body1 #description').val(description);
})
</script>
<script>
$('#modaldemo5').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id');
    var section_name = button.data('name');
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #section_name').val(section_name);
})
</script>
@endsection