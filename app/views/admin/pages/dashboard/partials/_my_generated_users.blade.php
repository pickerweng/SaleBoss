<div style="margin-bottom: 10px;">
          <div class="table-header Nassim Nassim700 NassimTitle panelColor" style="padding-right: 10px;" >
                <i class="fa fa-user"></i> مشتریانی که شما درست کرده اید
          </div>
          <div>
                <div class="form-inline">
                    <table class="table table-striped table-bordered table-hover tableFontSize12">
                           <thead>
                               <tr role="row">
                                    <th style="padding: 13px">شناسه #</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>نام </th>
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
	                                        <a class="blue" href="{{URL::to('customers/' . $user->id)}}">
                                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                            </a>
	                                    </td>
	                                </tr>
	                            @endforeach
	                        </tbody>
	                        <tfoot>
								<tr role="row">
									<td colspan="4" style="text-align: left">
										<a href="{{URL::to('my/customers')}}">مشاهده همه <i class="fa fa-arrow-circle-left"></i></a>
									</td>
								</tr>
	                        </tfoot>
                    </table>
                </div>
          </div>
</div>