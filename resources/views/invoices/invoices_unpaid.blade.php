@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
قائمة الفواتير غيرالمدفوعة 
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"> الفواتير غير المدفوعة </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
             @if (session()->has('delete_invoice'))
			 <script>
				window.onload = function(){
					notif({
						msg: "تم حذف الفاتورة بنجاح"
					    type:"success"
					})
				}
			 </script>
			 @endif
				<!-- row -->
				<div class="row">
				
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								   <div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block"  href="invoices/create">اضافة فاتورة</a>
							       </div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
											<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتورة</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0"> مبلغ التحصيل</th>
												<th class="border-bottom-0"> مبلغ العمولة</th>
												<th class="border-bottom-0"> الخصم</th>

												<th class="border-bottom-0">نسبة الضريبة</th>
												<th class="border-bottom-0">قيمة الضريبة</th>
												<th class="border-bottom-0">  اجمالي شامل الضريبة</th>
												<th class="border-bottom-0">  الحالة</th>

												<th class="border-bottom-0"> الملاحظات</th>
												<th class="border-bottom-0"> العمليات</th>

											</tr>
										</thead>
										<tbody>
											@foreach($invoices as $invoice)
											<tr>
												<td>{{$invoice->id}}</td>
												<td>{{$invoice->invoices_number}}</td>
												<td>{{$invoice->invoices_Date}}</td>
												<td>{{$invoice->Due_date}}</td>
												<td>
													<a href="{{url('InvoicesDetails')}}/{{$invoice->id}}"> {{$invoice->pro_section->section_name}}</a>
												</td>
												<td>{{$invoice->product}}</td>
												<td>{{$invoice->Amount_collection}}</td>
												<td>{{$invoice->Amount_commission}}</td>
												<td>{{$invoice->discount}}</td>
												<td>{{$invoice->Rate_VAT}}</td>
												<td>{{$invoice->Value_VAT}}</td>
												<td>{{$invoice->total}}</td>
												<td>

                                                  @if($invoice->value_Status ==1)
												  <span class="text-success">{{$invoice->status}}</span>
												  @elseif($invoice->value_Status ==2)
												  <span class="text-danger">{{$invoice->status}}</span>   
												  @else
												  <span class="text-warning">{{$invoice->status}}</span>
												  @endif
												</td>
												<td>{{$invoice->note}}</td>

												<td>
													
												<div class="dropdown">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
													data-toggle="dropdown" id="dropdownMenuButton" type="button">العمليات  <i class="fas fa-caret-down ml-1"></i></button>
													<div  class="dropdown-menu tx-13">
														<a class="dropdown-item" href="{{url('edit_invoice')}}/{{$invoice->id}}">تعديل</a>
														<a class="dropdown-item modal-effect " 
                                                                                    data-id="{{$invoice->id}}"
                                                                        data-toggle="modal" href="#model_delet">
                                                                        <i class="las la-trash"></i>حذف</a>

																		<a class="dropdown-item" 
                                                                        href="{{url('status_show')}}/{{$invoice->id}}">
                                                                        <i class="las fa-money-bill"></i>&nbsp;&nbsp;تعديل حالة الدفع</a>
													</div>
												</div>
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

		
				<!-- row closed -->
			</div>
			 	<!-- Modal alert message -->
	
				 <div class="modal" id="model_delet">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content tx-size-sm">
					<div class="modal-body tx-center pd-y-20 pd-x-20">
						<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
						
						<form action="{{route('invoices.destroy' , 'test')}}" method="post">
						    {{method_field('delete')}}
							{{csrf_field()}}
						<h4 class="tx-danger mg-b-20">تحذير هل انت متاكد من حذف الفاتورة </h4>
						<input type="hidden" name="invoices_id" id="invoices_id" value="">   
						<br>
						<br>
						<button  class="btn ripple btn-danger pd-x-25"  type="submit">حذف</button>
					
						</form>	
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal alert message -->
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script>
$('#model_delet').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id');

    var modal = $(this)
    modal.find('.modal-body #invoices_id').val(id);
 

})
</script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
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
@endsection