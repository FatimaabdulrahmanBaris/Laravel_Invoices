	<!-- تعديل القسم -->				
		<!-- Basic modal -->
		<div class="" id="update">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
					<h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body1">
						<form action="section/update" method="post" autocomplete="off" >
							<!-- {{method_field('PUT')}} -->
							{{csrf_field()}}
						
						<div class="form-group">
							<input type="hidden" name="id" id="id" value="">
							<label for="exampleInputEmail">اسم القسم</label>
							<input  id="sectionname"  name="sectionname" class="form-control" type="text">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">ملاحظات</label>
							
								<textarea name="des" id="des" class="form-control" cols="30" rows="10"></textarea>
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