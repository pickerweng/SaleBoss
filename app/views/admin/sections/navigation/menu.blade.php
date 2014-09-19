<ul class="nav navbar-nav navbar-left navbar-user" style="margin-left:-15px;">
    <li>
        <a style="min-width:150px;font-size: 18px" href="{{URL::to('stats/user/' . Sentry::getUser()->id)}}"><i class="fa fa-bar-chart-o"></i> آمار</a>
    </li>
    <li>
        <a style="min-width:150px;font-size: 18px" href="#"><i class="fa fa-calendar"></i> {{jDate::forge()->format('%B %d، %Y'); }}</a>
    </li>
    <li>
        <a href="{{URL::to('auth/logout')}}" style="font-size: 18px"><i class="fa fa-power-off"></i> خروج</a>
    </li>
</ul>
