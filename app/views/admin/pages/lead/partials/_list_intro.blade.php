<div class="row">
    <div class="col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-left" style="margin-top: 10px">
                        <p class="announcement-heading">{{$statistics['leads']}}</p>
                        <p class="announcement-text">لیدهای موجود</p>
                    </div>
                </div>
            </div>
            <a href="{{URL::to('leads')}}">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6">
                            مشاهده لیدها
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
                        <i class="fa fa-bookmark fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-left" style="margin-top: 10px">
                        <p class="announcement-heading">{{$statistics['myLeads']}}</p>
                        <p class="announcement-text">لیدهای فعال من</p>
                    </div>
                </div>
            </div>
            <a href="{{URL::to('admin/photo')}}" target="_blank">
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
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <i class="fa fa-inbox fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-left" style="margin-top:10px;">
                        <p class="announcement-heading">{{$statistics['myClosedLeads']}}</p>
                        <p class="announcement-text">لیدهای بسته شده ی من</p>
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
                        <i class="fa fa-check fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-left" style="margin-top: 10px ">
                        <p class="announcement-heading">50</p>
                        <p class="announcement-text">تعداد لیدهای موفق من</p>
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