@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معاينة فاتورة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div id="print" class=" main-content-body-invoice" >
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">الفاتورة</h1>
										<div class="billed-from">
											<h6>BootstrapDash, Inc.</h6>
											<p>201 Something St., Something Town, YT 242, Country 6546<br>
											Tel No: 324 445-4544<br>
											Email: youremail@companyname.com</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Billed To</label>
											<div class="billed-to">
												<h6>Juan Dela Cruz</h6>
												<p>4033 Patterson Road, Staten Island, NY 10301<br>
												Tel No: 324 445-4544<br>
												Email: youremail@companyname.com</p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">معلومات الفاتورة</label>
											<p class="invoice-info-row"><span>رقم الفاتورة </span> <span>{{$invoices->invoices_number}}</span></p>
											<p class="invoice-info-row"><span>تاريخ الاصدار </span> <span>{{$invoices->invoices_Date}}</span></p>
											<p class="invoice-info-row"><span>تاريخ الاستحقاق</span> <span>{{$invoices->Due_date}}</span></p>
											<p class="invoice-info-row"><span>القسم</span> <span>{{$invoices->discount}}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
												   <th class="wd-20p"> القسم</th>
													<th class="wd-20p">مبلغ التحصيل</th>
													<th class="wd-40p">مبلغ الحمولة</th>
													<th class="tx-center">الاجمالي</th>
												</tr>
											</thead>
											<tbody>
												<tr>
												<td >{{$invoices->product}}</td>
													<td>{{ number_format($invoices->Amount_collection,2)}}</td>
													<td class="tx-12">{{ number_format($invoices->Amount_commission,2)}}</td>
													@php 
													$total = $invoices->Amount_collection + $invoices->Amount_commission;
													@endphp
													<td class="tx-center">
														{{ number_format($total,2)}}
													</td>
												
												</tr>
												<tr>
													<td>الاجمالي</td>
													<td class="tx-12">
													{{ number_format($total,2)}}
													</td>
												
												</tr>
												<tr>
													<td>الخصم</td>
													<td class="tx-center">{{ number_format($invoices->discount,2)}}</td>
												
												</tr>
												<tr>
													<td>نسبة الضريبة </td>
													<td class="tx-center">{{ $invoices->Rate_VAT,2}}</td>
												
												</tr>
												<tr>
													<td>الاجمالي شامل الضريبة</td>
													<td class="tx-12">
													{{ number_format($invoices->total,2)}}
													</td>
												
												</tr>
												
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">
								
									
									<button class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
									<i class="mdi mdi-printer ml-1"></i>
									Print
									</button>
								
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script>
	function printDiv(){
		var printContents = document.getElementById('print').innerHTML;
		console.log(printContents);
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
		location.reload();

	}

</script>
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>


@endsection