@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
 <!--- Internal Select2 css-->
 <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل</span>
						</div>
					</div>
				
                </div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                <div class="example">
										<div class="panel panel-primary tabs-style-2">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
														<li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
														<li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab4">
                                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                                                            <thead>
                                                                                <tr>
                                                                                <th class="border-bottom-0">#</th>
                                                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                                                    <br>
                                                                                    <td scope="row">{{$invoices->invoices_number}}</td>
                                                                                    <th scope="row">تاريخ الاصدار</th>
                                                                                    <td scope="row">{{$invoices->invoices_Date}}</td>
                                                                                    <th scope="row">تاريخ الاستحقاق</th>
                                                                                    <td scope="row">{{$invoices->Due_date}}</td>

                                                                                    <th scope="row">القسم</th>
                                                                                    <td scope="row">{{$invoices->pro_section->section_name}}</td>
                                                                                </tr>
                                                                                <tr>   
                                                                                    <th scope="row">المنتج</th>
                                                                                    <td scope="row">{{$invoices->product}}</td>
                                                                                    
                                                                                    <th scope="row"> مبلغ التحصيل</th>
                                                                                    <td cscope="row">{{$invoices->Amount_collection}}</td>

                                                                                    <th scope="row"> مبلغ العمولة</th>
                                                                                    <td scope="row">{{$invoices->Amount_commission}}</td>

                                                                                    <th scope="row"> الخصم</th>
                                                                                    <td scope="row">{{$invoices->discount}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <th scope="row">نسبة الضريبة</th>
                                                                                    <td scope="row">{{$invoices->Value_VAT}}</td>

                                                                                    <th scope="row">قيمة الضريبة</th>
                                                                                    <td scope="row">{{$invoices->Rate_VAT}}</td>

                                                                                    <th scope="row">  اجمالي شامل الضريبة</th>
                                                                                    <td scope="row">{{$invoices->total}}</td>

                                                                                    <th scope="row">  الحالة</th>
                                                                                    <td>

                                                                                    @if($invoices->value_Status ==1)
                                                                                    <span class="text-success">{{$invoices->status}}</span>
                                                                                    @elseif($invoices->value_Status ==2)
                                                                                    <span class="text-danger">{{$invoices->status}}</span>   
                                                                                    @else
                                                                                    <span class="text-warning">{{$invoices->status}}</span>
                                                                                    @endif
                                                                                    </td>
                                                                                    <th scope="row"> الملاحظات</th>
                                                                                    <td scope="row">{{$invoices->note}}</td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            
                                                                                <tr>
                                                                                
                                                                                </tr>
                                                                            
                                                                            </tbody>
                                                            </table>
													</div>
													<div class="tab-pane" id="tab5">
	                                                         <table id="example1" class="table key-buttons text-md-nowrap">
                                                                    <thead>
                                                                        <tr>
                                                                        <th class="border-bottom-0">#</th>
                                                                            <th class="border-bottom-0">رقم الفاتورة</th>
                                                                            <th class="border-bottom-0">نوع المنتج</th>
                                                                            <th class="border-bottom-0"> القسم</th>
                                                                            <th class="border-bottom-0">حالة الدفع</th>
                                                                            <th class="border-bottom-0">تاريخ الدفع</th>
                                                                            <th class="border-bottom-0">  ملاحظات</th>
                                                                            <th class="border-bottom-0">  تاريخ الاضافة</th>
                                                                            <th class="border-bottom-0"> المستخدم</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($details as $x)
                                                                        <tr>
                                                                        <td>{{$x->id}}</td>
                                                                        
                                                                        <td>{{$x->invoice_number}}</td>
                                                                        <td>{{$x->product}}</td>
                                                                        <td>{{$invoices->pro_section->section_name}}</td>
                                                                        <td>

                                                                        @if($x->value_Status ==1)
                                                                        <span class="text-success">{{$x->status}}</span>
                                                                        @elseif($x->value_Status ==2)
                                                                        <span class="text-danger">{{$x->status}}</span>   
                                                                        @else
                                                                        <span class="text-warning">{{$x->status}}</span>
                                                                        @endif
                                                                        </td>
                                                                        <th scope="row"> الملاحظات</th>
    
                                                                        <td>{{$x->note}}</td>
                                                                        <td>{{$x->created_at}}</td>
                                                                        <td>{{$x->user}}</td>
                                                                     

                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                             </table>
                                                    </div>
                                                        <div class="tab-pane" id="tab6">
                                                         
                                                            <!--  -->
                                                            <form action="{{url('/InvoiceAttachment')}}" method="post" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                             <div class="input-group">
                                                             <input type="hidden" id="invoices_number" name="invoices_number" value="{{$invoices->invoices_number}}">
                                                                    <input type="hidden" id="invoices_id" name="invoices_id" value="{{$invoices->id}}">
                                                                    <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="customfile"
                                                                        aria-describedby="inputGroupFileAddon01" name="file_name" require> 
                                                                   
                                                                    <label class="custom-file-label" for="customfile">حدد المرفق</label>
                                                                    </div>
                                                                <button type="submit" class="btn btn-primary btn-sm" name="uploadedfile">تأكيد</button>

                                                            </div>
                                                              
                                                            </form>
                                                            <br>
                                                            <br><br>
                                                            <table id="example1" class="table key-buttons text-md-nowrap">
                                                                            <thead>
                                                                                <tr>
                                                                                <th class="border-bottom-0">م</th>
                                                                                    <th class="border-bottom-0">اسم الملف</th>
                                                                                    <th class="border-bottom-0">قام بالاضافة </th>
                                                                                    <th class="border-bottom-0">تاريخ الاضافة</th>
                                                                                    <th class="border-bottom-0">العمليات</th>
                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($attachments as $attachment)
                                                                                <tr>
                                                                                <td>{{$attachment->id}}</td>
                                                                                <td>{{$attachment->file_name}}</td>
                                                                                <td>{{$attachment->created_by}}</td>
                                                                                <td>{{$attachment->created_at}}</td>
                                                                                <td colspan="2">
                                                                          <a class="btn btn-autline-success btn-sm"
                                                                          href="{{url('view_file')}}/{{$invoices->invoices_number}}/{{$attachment->file_name}}"
                                                                          role="button"><i class="fas fa-eye"></i> عرض
                                                                        </a>

                                                                        <a class="btn btn-autline-success btn-sm"
                                                                          href="{{url('download')}}/{{$invoices->invoices_number}}/{{$attachment->file_name}}"
                                                                          role="button"><i class="fas fa-download"></i> تحميل المرفق
                                                                        </a>
                                                 
                                                                        <a  class="modal-effect btn btn-sm btn-danger" 
                                                                        data-file_name="{{$attachment->file_name}}"
                                                                                    data-invoice_number="{{$attachment->invoice_number}}"
                                                                                    data-id="{{$attachment->id}}"
                                                                        data-toggle="modal" href="#model_delet">
                                                                        <i class="las la-trash"></i>حذف
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
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
            	<!-- Modal alert message -->
	
			<div class="modal" id="model_delet">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content tx-size-sm">
					<div class="modal-body tx-center pd-y-20 pd-x-20">
						<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
						
						<form action="{{route('delete_file')}}" method="post">
						
							{{csrf_field()}}
						<h4 class="tx-danger mg-b-20">تحذير هل انت متاكد من حذف المرفق</h4>
						<input type="hidden" name="id" id="id" value="">

						<input  id="file_name"  name="file_name" class="form-control" type="text">
						<input  id="invoice_number"  name="invoice_number" class="form-control" type="text">

                       
						<br>
						<br>
						<button  class="btn ripple btn-danger pd-x-25"  type="submit">حذف</button>
					
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
<script>
$('#model_delet').on('show.bs.modal',function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id');
    var invoice_number = button.data('invoice_number');
    var file_name = button.data('file_name');

    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #invoice_number').val(invoice_number);
    modal.find('.modal-body #file_name').val(file_name);

})
</script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<!-- Internal Data tables -->
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
 <!-- Internal Select2 js-->
 <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

@endsection