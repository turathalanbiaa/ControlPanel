@extends("layout.main_layout")

@section("title")
    <title>الجدول الدراسي</title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>


        <div class="sixteen wide column">
            <div class="ui segment">
                <div class="ui center aligned green dividing large header">جميع الجداول الدراسية حسب المرحلة والشعبة</div>
                <div class="ui hidden divider"></div>
                <div class="ui four column center aligned grid">
                    @foreach($timetableMap as $timetable)
                        <div class="column">
                            <form class="ui form" method="post" action="/timetable/{{\App\Model\Student\Level::getLevelName($timetable->Level) . '-' . $timetable->Group}}/show">
                                {!! csrf_field() !!}
                                <input type="hidden" name="level" value="{{$timetable->Level}}">
                                <input type="hidden" name="group" value="{{$timetable->Group}}">
                                <button type="submit" class="ui fluid orange big button">
                                    <span>جدول الدراسي للمرحلة </span>
                                    <span>{{\App\Model\Student\Level::getLevelName($timetable->Level)}}</span>
                                    <span> - </span>
                                    <span>{{$timetable->Group}}</span>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection