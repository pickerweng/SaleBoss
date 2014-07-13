<ul class="nav navbar-nav navbar-left navbar-user" style="margin-left:-15px;">
    <!--li class="dropdown messages-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> پیام های ارسالی  <span class="badge">7</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">7 پیام جدید</li>
            <li class="message-preview">
                  <a href="#">
                      <span class="avatar"><img src="{{asset('assets/admin/img/avatars/' . rand(1,9) . '.gif')}}"></span>
                      <span class="name">علی دایی</span>
                      <span class="message">این عکس هایی که انداختی رو میشه ازت خرید...</span>
                      <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
            </li>
            <li class="divider"></li>
            <li class="message-preview">
                <a href="#">
                    <span class="avatar"><img src="{{asset('assets/admin/img/avatars/' . rand(1,9) . '.gif')}}"></span>
                    <span class="name">قنبر استقلالی</span>
                    <span class="message">عکس های زیبایی داری داداش دمت گرم خیلی با...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                </a>
            </li>
            <li class="divider"></li>
            <li class="message-preview">
                <a href="#">
                    <span class="avatar"><img src="{{asset('assets/admin/img/avatars/' . rand(1,9) . '.gif')}}"></span>
                    <span class="name">علیرضا قربانی:</span>
                    <span class="message">میخواستم از شما سوالی راجع به این بپرسم که آیا کار...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                </a>
            </li>
            <li class="divider"></li>
            <li><a href="#"> مشاهده اینباکس <span class="badge"> 7 </span></a></li>
        </ul>
    </li-->
    <li>
        <a href="#"><i class="fa fa-calendar"></i> {{jDate::forge()->format('%B %d، %Y'); }}</a>
    </li>
    <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Sentry::getUser()->email}} <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{URL::to('users/' . Sentry::getUser()->id)}}"><i class="fa fa-user"></i> {{Lang::get('strings.profile')}} </a></li>
            <li><a href="{{URL::to('users/' . Sentry::getUser()->id . '/edit')}}"><i class="fa fa-gear"></i> {{Lang::get('strings.settings')}} </a></li>
            <li class="divider"></li>
            <li><a href="{{URL::to('auth/logout')}}"><i class="fa fa-power-off"></i> {{Lang::get('strings.logout')}} </a></li>
        </ul>
    </li>
    <li>
        <a target="_blank" href="{{URL::to('/')}}"><i class="fa fa-home"></i></a>
    </li>
</ul>