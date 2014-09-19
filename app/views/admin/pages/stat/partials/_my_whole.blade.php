<div class="table-responsive">
	    <table class="table table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th>رتبه بندی بر اساس تعداد پنل های عادی تکمیل شده</th>
                    <th>تعداد فروخته شده</th>
                    <th>جمع قیمت</th>
                </tr>
            </thead>
            <tbody>
                    @if(! empty($scoreList))
                        @foreach($scoreList as $scorable)
                            <tr>
                                <td>{{$scorable->creator->getIdentifier()}}</td>
                                <td>{{$scorable->totalCount	}}</td>
                                <td>{{number_format($scorable->totalPrice)}} تومان</td>
                            </tr>
                        @endforeach
            		@endif
            </tbody>
        </table>
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed">
        <thead>
            <tr>
                <th>نام آمار</th>
                <th>مقدار</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>کل مشتریان موجود</td>
                <td>{{$stats->totalCustomers}}</td>
            </tr>
            <tr>
                <td>کل سفارش های موجود</td>
                <td>{{$stats->totalOrders}}</td>
            </tr>
            <tr>
                <td>کل لیدهای موجود</td>
                <td>{{$stats->totalLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای با وضعیت نامشخص</td>
                <td>{{$stats->totalUndefinedLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای باوضعیت  موفق</td>
                <td>{{$stats->totalSuccessfulLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای با وضعیت درانتظار</td>
                <td>{{$stats->totalPendingLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای با وضعیت ناموق</td>
                <td>{{$stats->totalUnsuccessfulLeads}}</td>
            </tr>
            <tr>
                <td>درصد لیدهای موفق به کل لیدها</td>
                <td>{{$stats->totalSuccessfulLeads}} / {{$stats->totalLeads}} ({{round(($stats->totalSuccessfulLeads/ ($stats->totalLeads + 1)) * 100)}}%)</td>
            </tr>
            <tr>
                <td>سفارش های با پنل عادی</td>
                <td>{{$stats->generalPanelOrders}} ({{round(($stats->generalPanelOrders/($stats->totalOrders + 1)) * 100)}}%)</td>
            </tr>
            <tr>
                <td>سفارش های با پنل آزمایشی</td>
                <td>{{$stats->exprimentalPanels}} ({{round(($stats->exprimentalPanels / ($stats->totalOrders + 1)) * 100)}}%)</td>
            </tr>
            <tr>
                <td>سفارش های با پنل رایگان</td>
                <td>{{$stats->freePanels}}</td>
            </tr>
            <tr>
                <td>سفارش های با پنل تخفیفی</td>
                <td>{{$stats->couponPanels}}</td>
            </tr>
            <tr>
                <td>سفارش های بدون پنل</td>
                <td>{{$stats->panelLess}}</td>
            </tr>
            <tr>
                <td>سفارش های پنل دار</td>
                <td>{{$stats->hasPanels}}</td>
            </tr>
            <tr>
                <td>سفارش های تکمیل شده</td>
                <td>{{$stats->completedOrders}}</td>
            </tr>
            <tr>
                <td>مشتریانی که از طریق لید ایجاد شده اند</td>
                <td>{{$stats->fromLeadCustomers}}</td>
            </tr>
            <tr>
                <td>مجموع سفارش های ایجاد شده توسط لید</td>
                <td>{{$stats->leadedOrderStats->totalCount}} ({{number_format($stats->leadedOrderStats->totalPrice)}} تومان)</td>
            </tr>
            <tr>
                <td>مجموع پول پنل</td>
                <td>{{number_format($stats->totalPanelPrice)}} تومان</td>
            </tr>
        </tbody>
    </table>
</div>
