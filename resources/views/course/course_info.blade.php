@extends("layout.main_layout")

@section("title")
    <title>معلومات الدورة</title>
@endsection

@section("content")
    <style>
        .ui.button
        {
           margin: 0;
        }
    </style>
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui five column grid">
                <div class="column">
                    <a href="/home" class="ui fluid big orange button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/course/create" class="ui fluid big orange button">اضافة دورة</a>
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

        @if(session("UpdateMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("UpdateMessage")}}</h2>
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
            <div class="ui segment">
                <div class="ui right aligned grid">
                    <div class="eight wide column">

                        <form class="ui large form" method="post" action="/course/update">
                            <h2 class="ui center aligned dividing header">بيانات الدورة</h2>
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$course->ID}}">

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="name">اسم الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <input type="text" name="name" value="{{$course->Name}}" id="name">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="lecturer-ID">اسم الأستاذ</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="lecturerID" value="{{$course->Lecturer_ID}}" id="lecturer-ID">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"></div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            @foreach($lecturers as $lecturer)
                                                <div class="item" data-value="{{$lecturer->ID}}">{{$lecturer->Name}}</div>
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
                                        <input type="hidden" name="type" value="{{$course->Type}}" id="type">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> {{\App\Model\Course\CourseType::getCourseTypeName($course->Type)}} </div>
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
                                        <input type="hidden" name="level" value="{{$course->Level}}" id="level">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> {{\App\Model\Course\CourseType::getCourseTypeName($course->Level)}} </div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            <div class="item" data-value="{{\App\Model\Student\Level::BEGINNER}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::BEGINNER)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_FIRST_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_FIRST_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_TWO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_SECOND_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_SECOND_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_TWO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_THIRD_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_ONE)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::INTRO_THIRD_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_TWO)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="detail">تفاصيل الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <textarea rows="5" name="detail" id="detail">{{$course->Detail}}</textarea>
                                </div>
                            </div>

                            <div class="inline fields">
                                <button type="submit" class="ui teal large button" style="margin: auto;">حفظ التعديلات</button>
                            </div>
                        </form>
                    </div>
                    <div class="eight wide column">
                        <h2 class="ui center aligned dividing header">معلومات أخرى</h2>
                        <div class="ui inverted segment">
                            <h3 class="ui right aligned dividing header">أسم الأستاذ : <smal>{{$course->Lecturer->Name}}</smal></h3>
                            <h3 class="ui right aligned dividing header">عدد الدروس : <small>{{$lessonsCount}}</small></h3>
                            <h3 class="ui right aligned dividing header">تقييم الدورة : <small>{{$rating}}</small> من 5</h3>
                            <h3 class="ui right aligned dividing header">عدد المسجلين في الدورة : <small>{{$courseEnrollCount}}</small></h3>

                            <div class="ui divider"></div>
                            <div class="ui divider"></div>

                            <a href="/lecturer/info-{{$course->Lecturer_ID}}" class="fluid massive ui animated fade inverted basic button">
                                <div class="visible content">عرض معلومات الأستاذ</div>
                                <div class="hidden content">{{$course->Lecturer->Name}}</div>
                            </a>

                            <div class="ui hidden divider"></div>
                            <div class="ui hidden divider"></div>

                            <a href="/{{$course->ID}}/lessons" class="fluid massive ui animated fade inverted basic button">
                                <div class="visible content">عرض جميع الدروس</div>
                                <div class="hidden content">{{$course->Name}}</div>
                            </a>
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