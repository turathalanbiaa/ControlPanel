<table class="ui large right aligned table">
    <thead>
    <tr>
        <th>ID</th>
        <th>اسم الدورة</th>
        <th>اسم الإستاذ</th>
        <th>نوع الدورة</th>
        <th>المرحلة</th>
        <th style="width: 100px !important; text-align: center;">خيارات</th>
    </tr>
    </thead>

    <tbody>
    @if($courses->count() > 0)
        @foreach($courses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui teal button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui red button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
                    </div>
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