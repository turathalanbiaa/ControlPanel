@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::BEGINNER);}); @endphp
<h3 class="ui center aligned red header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::BEGINNER)}}</h3>
<table class="ui right aligned red table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::INTRO_FIRST_PART_ONE);}); @endphp
<h3 class="ui center aligned green header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_ONE)}}</h3>
<table class="ui right aligned green table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::INTRO_FIRST_PART_TWO);}); @endphp
<h3 class="ui center aligned green header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_TWO)}}</h3>
<table class="ui right aligned green table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::INTRO_SECOND_PART_ONE);}); @endphp
<h3 class="ui center aligned blue header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_ONE)}}</h3>
<table class="ui right aligned blue table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::INTRO_SECOND_PART_TWO);}); @endphp
<h3 class="ui center aligned blue header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_TWO)}}</h3>
<table class="ui right aligned blue table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::INTRO_THIRD_PART_ONE);}); @endphp
<h3 class="ui center aligned orange header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_ONE)}}</h3>
<table class="ui right aligned orange table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == \App\Model\Student\Level::INTRO_THIRD_PART_TWO);}); @endphp
<h3 class="ui center aligned orange header">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_TWO)}}</h3>
<table class="ui right aligned orange table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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

<div class="ui hidden divider"></div>
<div class="ui hidden divider"></div>

@php $subCourses = $courses->filter(function ($course){return ($course->Level == 10);}); @endphp
<h3 class="ui center aligned pink header">دورات عامة</h3>
<table class="ui right aligned pink table">
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
    @if(count($subCourses) > 0)
        @foreach($subCourses as $course)
            <tr>
                <td>{{$course->ID}}</td>
                <td>{{$course->Name}}</td>
                <td>{{$course->Lecturer->Name}}</td>
                <td>{{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}}</td>
                <td>{{\App\Model\Student\Level::getLevelName($course->Level)}}</td>
                <td style="width: 80px !important; text-align: center;">
                    <div class="ui mini vertical buttons">
                        <a class="ui button" href="/course/info-{{$course->ID}}">عرض</a>
                        <button class="ui button" data-action="delete-course" data-id="{{$course->ID}}" data-content="{{$course->Name}}">حذف</button>
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