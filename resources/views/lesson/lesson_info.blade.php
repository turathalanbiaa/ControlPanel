@extends("layout.main_layout")

@section("title")
    <title> {{$lesson->Title}} </title>
@endsection

@section("content")
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
                    <a href="/lesson/create" class="ui fluid big orange button">أضافة درس</a>
                </div>

                <div class="column">
                    <a href="/courses/groups" class="ui fluid big orange button">المراحل</a>
                </div>
            </div>
        </div>

        @if(session("AddQuestion"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("AddQuestion")}}</h2>
                </div>
            </div>
        @endif

        @if(session("DeleteQuestion"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("DeleteQuestion")}}</h2>
                </div>
            </div>
        @endif

        @if(session("NotFoundQuestion"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("NotFoundQuestion")}}</h2>
                </div>
            </div>
        @endif

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
                <div class="ui grid">
                    <div class="eight wide column">
                        <form class="ui big form" method="post" action="/lesson/update">
                            <h2 class="ui center aligned dividing header">معلومات الدرس</h2>
                            {!! csrf_field() !!}
                            <input type="hidden" name="ID" value="{{$lesson->ID}}">

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="title">عنوان الدرس</label>
                                </div>
                                <div class="thirteen wide field">
                                    <input type="text" name="title" value="{{$lesson->Title}}" id="title">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="course-ID">اسم الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="courseID" value="{{$lesson->Course_ID}}" id="course-ID">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">  </div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            @foreach($courses as $course)
                                                <div class="item" data-value="{{$course->ID}}">{{$course->Name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="lecturer-ID">اسم الأستاذ</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="lecturerID" value="{{$lesson->Lecturer_ID}}" id="lecturer-ID-ID">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">  </div>
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
                                    <label for="youtubeVideoID">VideoID</label>
                                </div>
                                <div class="thirteen wide field">
                                    <input type="text" name="youtubeVideoID" value="{{$lesson->YoutubeVideoId}}" id="youtubeVideoID">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="description">الوصف</label>
                                </div>
                                <div class="thirteen wide field">
                                    <textarea rows="5" name="description" id="description">{{$lesson->Description}}</textarea>
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
                            <div class="ui embed" data-source="youtube" data-id="{{$lesson->YoutubeVideoId}}" data-placeholder="/images/image-16by9.png"></div>

                            <h3 class="ui right aligned dividing header">
                                <span style="float: right;">عدد المشاهدات : <small>{{count($lesson->views)}}</small></span>
                                <span style="float: left;">عدد التعليقات : <small>{{count($lesson->comments)}}</small></span>
                            </h3>

                            <h3 class="ui right aligned dividing header">الرابط على الموقع : <a target="_blank" href="{{'http://turathalanbiaa.com/lesson/' . $lesson->ID}}" style="color: red;">{{'http://turathalanbiaa.com/lesson/' . $lesson->ID}}</a></h3>

                            <div class="ui divider"></div>

                            <a href="/lecturer/info-{{$lesson->Lecturer_ID}}" class="fluid massive ui animated fade inverted basic button">
                                <div class="visible content">عرض معلومات الأستاذ</div>
                                <div class="hidden content">{{$lesson->Lecturer->Name}}</div>
                            </a>

                            <div class="ui hidden divider"></div>
                            <div class="ui hidden divider"></div>

                            <a href="/{{$lesson->Course_ID}}/lessons" class="fluid massive ui animated fade inverted basic button">
                                <div class="visible content">عرض جميع الدروس</div>
                                <div class="hidden content">{{$lesson->Course->Name}}</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sixteen wide column">
            <div class="ui segment">
                @include("e_exam.show_question")
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

        $('.ui.embed').embed();
    </script>
@endsection