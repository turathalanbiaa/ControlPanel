<table class="ui right aligned table">
    <thead>
        <tr>
            <th>ID</th>
            <th>اسم الطالب</th>
            <th>البريد الإلكتروني</th>
            <th>الهاتف</th>
            <th>تاريخ التسجيل</th>
            <th>المرحلة</th>
            <th>الشعبة</th>
            <th style="width: 80px !important; text-align: center;">خيارات</th>
        </tr>
    </thead>

    <tbody>
    @if($students->count() > 0)
        @foreach($students as $student)
            <tr>
                <td>{{$student->ID}}</td>
                <td>
                    <a href="/student/info-{{$student->ID}}" style="color: rgba(0,0,0,.87);">{{$student->Name}}</a>
                </td>
                <td>{{$student->Email}}</td>
                <td>{{$student->Phone}}</td>
                <td>{{$student->RegisterDate}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($student->Level)}}</td>
                <td>{{$student->Group}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a href="/student/info-{{$student->ID}}" class="ui green button">عرض</a>
                        <button class="ui red button" data-action="delete-student" data-id="{{$student->ID}}" data-content="{{$student->Name}}">حذف</button>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="7">
                <div class="md-space"></div>
                <div class="md-space"></div>
                <h1 class="center aligned">لا توجد نتأئج</h1>
                <div class="md-space"></div>
                <div class="md-space"></div>
            </td>
        </tr>
    @endif

    </tbody>
</table>