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
            <div class="ui four column grid">
                <div class="column">
                    <a href="/home" class="ui fluid orange big button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/timetable/levels" class="ui fluid orange big button">عرض الجداول الدراسية لكل مرحلة</a>
                </div>
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
                    <div class="eight wide column">
                        <form class="ui big form" method="post" action="/timetable/add-lesson-validate">
                            {!! csrf_field() !!}
                            <input type="hidden" name="level" value="{{$level}}">
                            <input type="hidden" name="group" value="{{$group}}">

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="l">المرحلة :- </label>
                                </div>

                                <div class="thirteen wide field">
                                    <input type="text" name="l" id="l" value="{{\App\Model\Student\Level::getLevelName($level)}}" disabled="disabled">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="g">الشعبة :- </label>
                                </div>

                                <div class="thirteen wide field">
                                    <input type="text" name="g" id="g" value="{{$group}}" disabled="disabled">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="date">التاريخ :- </label>
                                </div>

                                <div class="thirteen wide field">
                                    <input type="date" name="date" id="date" value="">
                                </div>
                            </div>

                            <?php $i = 1;?>
                            @foreach($courses as $course)
                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label for="{{'course-' . $i}}"><sapn>المادة - </sapn><span>{{$i}}</span></label>
                                    </div>

                                    <div class="thirteen wide field">
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
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach

                            <input type="hidden" name="count" value="{{count($courses)}}">
                            <div class="inline fields">
                                <div class="sixteen wide field">
                                    <button type="submit" class="ui big teal button" style="margin: auto;">ارسال</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="eight wide column"></div>
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
        $('.ui.form')
            .form({
                fields: {
                    date: {
                        identifier: 'date',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'لم تقوم باختيار التاريخ'
                            }
                        ]
                    }
                }
            })
        ;
    </script>
@endsection