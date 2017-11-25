@extends("layout.main_layout")

@section("title")
    <title>جدول الدراسي لكل مرحلة</title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui fluid black large five buttons">
                <a href="/home"  class="ui button">الرئيسية</a>
                <a href="/timetable/pre-add-lessons" class="ui button">اضافة دروس الى الجدول الدراسي</a>
                <a href="/timetable/pre-update-lessons" class="ui button">تعديل دروس الجدول الدراسي</a>
                <a href="/timetable" class="ui button">بحث دروس في الجدول الدراسي</a>
                <a href="/timetable/show-timetable-for-levels" class="ui button">عرض الجداول الدراسية</a>
            </div>
        </div>

        <div class="sixteen wide column">
            @include("timetable.fixedTimeTable.timeTableForBeginner")

            @include("timetable.fixedTimeTable.timeTableForFirstLevelIntro")

            @include("timetable.fixedTimeTable.timeTableForSecondLevelIntro")
        </div>
    </div>
@endsection