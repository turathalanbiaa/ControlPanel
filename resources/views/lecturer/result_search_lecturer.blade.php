<table class="ui large right aligned table">
    <thead>
    <tr>
        <th>ID</th>
        <th>اسم الإستاذ</th>
        <th>البريد الإلكتروني</th>
        <th>الهاتف</th>
        <th>الشهادة</th>
        <th style="width: 100px !important; text-align: center;">خيارات</th>
    </tr>
    </thead>

    <tbody>
    @if($lecturers->count() > 0)
        @foreach($lecturers as $lecturer)
            <tr>
                <td>{{$lecturer->ID}}</td>
                <td>{{$lecturer->Name}}</td>
                <td>{{$lecturer->Email}}</td>
                <td>{{$lecturer->Phone}}</td>
                <th>{{$lecturer->ScientificDegree}}</th>
                <td style="width: 80px !important; text-align: center;">
                    <a class="ui teal button" href="/lecturer/info-{{$lecturer->ID}}">عرض</a>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">
                <div class="lg-space"></div>
                <div class="lg-space"></div>
                <h1 class="center aligned">لا توجد نتأئج</h1>
                <div class="lg-space"></div>
            </td>
        </tr>
    @endif
    </tbody>
</table>