@extends("layout.main_layout")

@section("title")
    <title>أضافة الدورة</title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui four column grid">
                <div class="column">
                    <a href="/home" class="ui fluid big orange button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/courses/show" class="ui fluid big orange button">بحث عن دورة</a>
                </div>

                <div class="column">
                    <form method="post" action="/lessons/search">
                        {!! csrf_field() !!}
                        <input type="hidden" name="query" value="">
                        <button type="submit" class="ui fluid big orange button">بحث عن درس</button>
                    </form>
                </div>

                <div class="column">
                    <a href="/courses/groups" class="ui fluid big orange button">المراحل الدراسية</a>
                </div>
            </div>
        </div>

        @if(session("CreateMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("CreateMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(count($errors))
            <div class="sixteen wide column">
                <div class="ui error message" id="message">
                    <ul class="list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="sixteen wide column">
            <div  style="background-color: #FFFAF3; padding: 15px 0;">
                <div class="ui right aligned grid">
                    <div class="eight wide column">
                        <form class="ui big form" method="post" action="/course/create/validation">
                            <h2 class="ui center aligned dividing header">بيانات الدورة</h2>
                            {!! csrf_field() !!}

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="name">اسم الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <input type="text" name="name" value="" id="name">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="lecturer-ID">اسم الأستاذ</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="lecturerID" value="" id="lecturer-ID">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> أختر الأستاذ </div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            @foreach($lecturer as $lecture)
                                                <div class="item" data-value="{{$lecture->ID}}">{{$lecture->Name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="type">نوع الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="type" value="" id="type">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> أختر نوع الدورة </div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            <div class="item" data-value="{{\App\Model\Course\CourseType::GENERAL_COURSE}}">{{\App\Model\Course\CourseType::getCourseTypeName(\App\Model\Course\CourseType::GENERAL_COURSE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Course\CourseType::STUDY_COURSE}}">{{\App\Model\Course\CourseType::getCourseTypeName(\App\Model\Course\CourseType::STUDY_COURSE)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="level">المرحلة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="level" value="" id="level">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> أختر المرحلة </div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            <div class="item" data-value="{{\App\Model\Student\Level::BEGINNER}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::BEGINNER)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_FIRST_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_FIRST_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_TWO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_SECOND_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_SECOND_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_TWO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_THIRD_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_THIRD_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_TWO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::SETOH_BEGINNER_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::SETOH_BEGINNER_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::SETOH_BEGINNER_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::SETOH_BEGINNER_PART_TWO)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="detail">تفاصيل الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <textarea rows="5" name="detail" id="detail"></textarea>
                                </div>
                            </div>

                            <div class="inline fields">
                                <button type="submit" class="ui teal large button" style="margin: auto;">ارسال</button>
                            </div>
                        </form>
                    </div>
                    <div class="eight wide column">
                        <div class="ui center aligned image">
                            <img src="{{asset("assets/images/Courses.jpg")}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.radio.checkbox').checkbox();
        $('.ui.selection.dropdown').dropdown();
        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });
    </script>
@endsection