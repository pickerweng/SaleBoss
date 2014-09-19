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
                <td>{{$totalCustomers}}</td>
            </tr>
            <tr>
                <td>کل سفارش های موجود</td>
                <td>{{$totalOrders}}</td>
            </tr>
            <tr>
                <td>کل کاربران سیستمی موجود</td>
                <td>{{$totalSystemUsers}}</td>
            </tr>
            <tr>
                <td>کل لیدهای موجود</td>
                <td>{{$totalLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای با وضعیت نامشخص</td>
                <td>{{$totalUndefinedLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای باوضعیت  موفق</td>
                <td>{{$totalSuccessfulLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای با وضعیت درانتظار</td>
                <td>{{$totalPendingLeads}}</td>
            </tr>
            <tr>
                <td>لیدهای با وضعیت ناموق</td>
                <td>{{$totalUnsuccessfulLeads}}</td>
            </tr>
            <tr>
                <td>درصد لیدهای موفق به کل لیدها</td>
                <td>{{$totalSuccessfulLeads}} / {{$totalLeads}} ({{round(($totalSuccessfulLeads/ ($totalLeads+ 1)) * 100)}}%)</td>
            </tr>
            <tr>
                <td>سفارش های با پنل عادی</td>
                <td>{{$generalPanelOrders}} ({{round(($generalPanelOrders/($totalOrders + 1)) * 100)}}%)</td>
            </tr>
            <tr>
                <td>سفارش های با پنل آزمایشی</td>
                <td>{{$experimentalPanels}} ({{round(($experimentalPanels / ($totalOrders + 1)) * 100)}}%)</td>
            </tr>
            <tr>
                <td>سفارش های با پنل رایگان</td>
                <td>{{$freePanels}}</td>
            </tr>
            <tr>
                <td>سفارش های با پنل تخفیفی</td>
                <td>{{$couponPanels}}</td>
            </tr>
            <tr>
                <td>سفارش های بدون پنل</td>
                <td>{{$panelLess}}</td>
            </tr>
            <tr>
                <td>سفارش های پنل دار</td>
                <td>{{$hasPanels}}</td>
            </tr>
            <tr>
                <td>سفارش های تکمیل شده</td>
                <td>{{$completedOrders}}</td>
            </tr>
            <tr>
                <td>مشتریانی که از طریق لید ایجاد شده اند</td>
                <td>{{$fromLeadCustomers}}</td>
            </tr>
            <tr>
                <td>مجموع پول پنل</td>
                <td>{{number_format($totalPanelPrice)}} تومان</td>
            </tr>
        </tbody>
    </table>
</div>
