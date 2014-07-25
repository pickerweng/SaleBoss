<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
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
            <td>{{$customer->creator->getIdentifier()}}</td>
            <td class="languageLeft">
                @include('admin.pages.customer._my_operation')
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>