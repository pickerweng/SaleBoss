<div class="well">
	<h4><strong>همیشه جستجو کنید!</strong></h4>
	<div class="row">
		<div class="col-sm-12">
			{{Form::open(['method' => 'get', 'url' => Request::path()])}}
				<div class="col-sm-12">
					<div class="checkbox-inline">
						<label>
							{{Form::checkbox('completed', 1,Input::get('completed'))}}
							تکمیل شده
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							{{Form::checkbox('priority[]', 1, (Input::get('priority') == 1) ? true : false  )}}
							صف فروش
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							{{Form::checkbox('priority[]', 2, (Input::get('priority') == 2) ? true : false  )}}
							صف حسابداری
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							{{Form::checkbox('priority', 3, (Input::get('priority') == 3) ? true : false  )}}
							صف پشتیبانی
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							{{Form::checkbox('suspended', 1, Input::get('suspended'))}}
							معلق شده
						</label>
					</div>
					<div class="col-sm-12 col-lg-3 col-lg-offset-9 col-md-4 col-md-offset-8">
						{{Form::submit('بگرد!',['class' => 'btn btn-info btn-block btn-lg'])}}
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>