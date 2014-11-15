        <div class="table-header Nassim Nassim700 NassimTitle panelColor" style="padding-right: 10px;" >
                <i class="fa fa-user"></i> لیست مشتریان
          </div>
          <div>
                <div class="form-inline">
                    <table class="table table-striped table-bordered table-hover tableFontSize12">
                           <thead>
                               <tr role="row">
                                    <th style="padding: 13px">#شناسه</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th class="languageLeft">شماره تلفن</th>
                                    <th class="languageLeft">شماره موبایل</th>
                                    <th class="languageLeft">ایمیل</th>
                                    <th>ایجاد کننده</th>
                                    <th class="languageLeft">عملیات</th>
                               </tr>
                           </thead>
                           <tbody>
                                    @foreach($myCustomers as $customer)
                                       <tr>
                                           <td>{{$customer->id}}</td>
                                           <td>{{$customer->name()}}</td>
                                           <td class="languageLeft">{{$customer->tell}}</td>
                                           <td class="languageLeft">{{$customer->mobile}}</td>
                                           <td class="languageLeft">{{$customer->email}}</td>
                                           <td><a href="{{URL::to(Request::path() . '?creator_id='. $customer->creator_id)}}">{{$customer->creator->getIdentifier()}}</a></td>
                                           <td class="languageLeft">
                                               @include('admin.pages.customer._my_operation')
                                           </td>
                                       </tr>
                                   @endforeach
                           </tbody>
                    </table>
                </div>
          </div>