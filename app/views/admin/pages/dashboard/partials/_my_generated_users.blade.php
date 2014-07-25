<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-user"></i> مشتریانی که شما درست کرده اید</h3>
	</div>
	<div class="panel-body">
		<div class="list-group">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped tablesorter">
					<thead>
					<tr>
						<th>شناسه # <i class="fa fa-sort"></i></th>
						<th>تاریخ ایجاد</th>
						<th>نام <i class="fa fa-sort"></i></th>
						<th class="languageLeft">عملیات</th>
					</tr>
					</thead>
					<tbody>
						@foreach($generatedUsers as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->diff()}}</td>
								<td>{{$user->name()}}</td>
								<td class="languageLeft">
									<a target="_blank" href="{{URL::to('customers/' . $user->id)}}" class="btn btn-warning btn-xs">مشاهده</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="text-left">
			<a href="{{URL::to('my/customers')}}">مشاهده همه <i class="fa fa-arrow-circle-left"></i></a>
		</div>
	</div>
</div>