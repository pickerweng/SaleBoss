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
                        <p class="announcement-heading">5</p>
                        <p class="announcement-text">کاربران سیستم</p>
                    </div>
                </div>
            </div>
            <a href="{{URL::to('admin/user')}}">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">
                            مشاهده کاربران
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
                        <i class="fa fa-picture-o fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-left">
                        <p class="announcement-heading">4</p>
                        <p class="announcement-text">عکس های ایجاد شده</p>
                    </div>
                </div>
            </div>
            <a href="{{URL::to('admin/photo')}}" target="_blank">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">
                            مشاهده عکس ها
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
                        <i class="fa fa-inbox fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-left">
                        <p class="announcement-heading">6</p>
                        <p class="announcement-text">خودروهای موجود</p>
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