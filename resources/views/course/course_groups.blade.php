@extends("layout.main_layout")

@section("title")
    <title>المراحل الدراسية</title>
@endsection

@section("content")
    <style>
        .ui.segment {
            min-height: 500px;
        }
        
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
            <div class="ui four column grid">
                <div class="column">
                    <a href="/home" class="ui fluid big orange button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/course/create" class="ui fluid big orange button">أضافة دورة</a>
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
            </div>
        </div>

        <div class="sixteen wide column">
            <div class="ui two column grid">
                <div class="column">
                    <div class="ui segment">
                        <h2 class="ui center aligned header"> الدورات التي تعطى للطلاب وعددها <span>{{$totalCountCourses["totalCountStudyCourses"]}}</span></h2>
                        <div class="ui divider"></div>

                        <div class="ui accordion">
                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة التمهيدية</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["beginner"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::BEGINNER)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>

                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة المقدمات الأولى</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["firstLevelIntro"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::FIRST_LEVEL_INTRO)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>

                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة المقدمات الثانية</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["secondLevelIntro"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::SECOND_LEVEL_INTRO)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>

                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة المقدمات الثالثة</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["thirdLevelIntro"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::THIRD_LEVEL_INTRO)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>

                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة السطوح الأولى</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["firstLevelUp"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::FIRST_LEVEL_UP)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>

                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة السطوح الثانية</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["secondLevelUp"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::SECOND_LEVEL_UP)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>

                            <div class="title">
                                <i class="dropdown icon"></i>
                                <span>المرحلة السطوح الثالثة</span>
                            </div>
                            <div class="content">
                                @if($studyCourses["thirdLevelUp"] > 0)
                                    <ol>
                                        <?php $courses = App\Model\Course\Course::where('Level','=',\App\Model\Student\Level::THIRD_LEVEL_UP)->where('Type','=',\App\Model\Course\CourseType::STUDY_COURSE)->get();?>
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="ui info message">
                                        <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="column">
                    <div class="ui segment">
                        <h2 class="ui center aligned header">الدورات العامه وعددها <span>{{$totalCountCourses["totalCountGeneralCourses"]}}</span></h2>
                        <div class="ui divider"></div>

                        @if($generalCourses["general"] > 0)
                            <ol>
                                <?php $courses = App\Model\Course\Course::where('Type','=',\App\Model\Course\CourseType::GENERAL_COURSE)->get();?>
                                @foreach($courses as $course)
                                    <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="ui info message">
                                <h4 class="ui center aligned header">لاتوجد دروس لهذة المرحلة</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.accordion').accordion();
    </script>
@endsection