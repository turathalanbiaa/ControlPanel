@extends("layout.main_layout")

@section("title")
    <title>اضافة الدروس الى الجدول الدراسي</title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui fluid black large four buttons">
                <a href="/home"  class="ui button">الرئيسية</a>
                <a href="/timetable" class="ui button">بحث دروس</a>
                <a href="/timetable/pre-update-lessons" class="ui button">تعديل دروس</a>
                <a href="/timetable/show-timetable-for-levels" class="ui button">عرض الجداول الدراسية</a>
            </div>
        </div>

        @if(session("AddLessonMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("AddLessonMessage")}}</h2>
                </div>
            </div>
        @endif

        <div class="sixteen wide column">
            <div class="ui segment">
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <form class="ui big form" method="post" action="/timetable/add-lessons">
                            {!! csrf_field() !!}
                            <input type="hidden" name="level" value="{{$level}}">
                            <input type="hidden" name="group" value="{{$group}}">
                            <input type="hidden" name="count" value="{{count($courses)}}">

                            <div class="inline fields">
                                <div class="two wide field">
                                    <label for="date">التاريخ :- </label>
                                </div>

                                <div class="fourteen wide field">
                                    <input type="date" name="date" value="">
                                </div>
                            </div>

                            <?php $i = 1;?>
                            @foreach($courses as $course)
                                <div class="inline fields">
                                    <div class="five wide field">
                                        <label for="{{'course-' . $i}}"><sapn>المادة - </sapn><span>{{$course->Name}}</span></label>
                                    </div>

                                    <div class="eleven wide field">
                                        <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                            <input type="hidden" name="{{'course-' . $i}}" id="{{'course-' . $i}}">
                                            <i class="dropdown icon"></i>
                                            <div class="default text"> {{$course->Name}} </div>
                                            <div class="menu transition hidden" tabindex="-1">
                                                @foreach($course->Lessons as $lesson)
                                                    <div class="item" data-value="{{$lesson->ID}}">{{$lesson->Title}}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="ui red button" data-action="clear">مسح</div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach

                            <div class="inline fields">
                                <div class="five wide field"></div>
                                <div class="eleven wide field">
                                    <button type="submit" class="ui big green button" style="margin: auto !important;">حفظ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.selection.dropdown').dropdown();
        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });
        $('.ui.form').form({
            fields: {
                date: {rules: [{type   : 'empty'}]}
            }
        });
        $("div[data-action='clear']").click(function ()
        {
            var list = $(this).parent().find('.ui.selection.dropdown');
            list.dropdown('clear');
        });
    </script>
@endsection