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
            @include("timetable.fixedTimeTable.timeTableForBeginner")

            @include("timetable.fixedTimeTable.timeTableForFirstLevelIntro")

            @include("timetable.fixedTimeTable.timeTableForSecondLevelIntro")
        </div>
    </div>
@endsection