@section('intro')
<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-xs-6 text-left">
						<p class="announcement-heading">{{$jangoolak['number_of_users'] - $jangoolak['number_of_customers']}}</p>
						<p class="announcement-text">کاربران سیستمی</p>
					</div>
				</div>
			</div>
			<a href="{{URL::to('users')}}">
				<div class="panel-footer announcement-bottom">
					<div class="row">
						<div class="col-xs-6">
							مشاهده کاربران سیستمی
						</div>
						<div class="col-xs-6 text-left">
							<i class="fa fa-arrow-circle-left"></i>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-6 text-left">
						<p class="announcement-heading">{{$jangoolak['number_of_customers']}}</p>
						<p class="announcement-text">مشتریان</p>
					</div>
				</div>
			</div>
			<a href="{{URL::to('users')}}" target="_blank">
				<div class="panel-footer announcement-bottom">
					<div class="row">
						<div class="col-xs-6">
							مشاهده مشتریان
						</div>
						<div class="col-xs-6 text-left">
							<i class="fa fa-arrow-circle-left"></i>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6">
						<i class="fa fa-bullhorn fa-5x"></i>
					</div>
					<div class="col-xs-6 text-left">
						<p class="announcement-heading">10</p>
						<p class="announcement-text">فعالیت های کاربران</p>
					</div>
				</div>
			</div>
			<a href="{{URL::to('admin/car')}}">
				<div class="panel-footer announcement-bottom">
					<div class="row">
						<div class="col-xs-6">
							مشاهده لیست
						</div>
						<div class="col-xs-6 text-left">
							<i class="fa fa-arrow-circle-left"></i>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6">
						<i class="fa fa-bookmark fa-5x"></i>
					</div>
					<div class="col-xs-6 text-left">
						<p class="announcement-heading">8</p>
						<p class="announcement-text">برندهای موجود</p>
					</div>
				</div>
			</div>
			<a href="{{URL::to('admin/brand')}}">
				<div class="panel-footer announcement-bottom">
					<div class="row">
						<div class="col-xs-6">
							مشاهده لیست
						</div>
						<div class="col-xs-6 text-left">
							<i class="fa fa-arrow-circle-left"></i>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
@show