@extends("layout.main_layout")

@section("title")
    <title> أضافة درس </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui four column grid">
                <div class="column">
                    <a href="/home" class="ui fluid massive orange button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/courses/show" class="ui fluid massive orange button">بحث عن دورة</a>
                </div>

                <div class="column">
                    <form method="post" action="/lessons/search">
                        {!! csrf_field() !!}
                        <input type="hidden" name="query" value="">
                        <button type="submit" class="ui fluid massive orange button">بحث عن درس</button>
                    </form>
                </div>

                <div class="column">
                    <a href="/courses/groups" class="ui fluid massive orange button">المراحل</a>
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
            <div class="ui segment">
                <div class="ui grid">
                    <div class="eight wide column">
                        <form class="ui large form" method="post" action="/lesson/create/validation">
                            <h2 class="ui center aligned dividing header">معلومات الدرس</h2>
                            {!! csrf_field() !!}
                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="title">عنوان الدرس</label>
                                </div>
                                <div class="thirteen wide field">
                                    <input type="text" name="title" value="" id="title">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="course-ID">اسم الدورة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="courseID" value="" id="course-ID">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> أختر اسم الدورة </div>
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
                                        <input type="hidden" name="lecturerID" value="" id="lecturer-ID-ID">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> أختر اسم الأستاذ </div>
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
                                    <input type="text" name="youtubeVideoID" value="" id="youtubeVideoID">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label for="description">الوصف</label>
                                </div>
                                <div class="thirteen wide field">
                                    <textarea rows="5" name="description" id="description"></textarea>
                                </div>
                            </div>

                            <div class="inline fields">
                                <button type="submit" class="ui teal large button" style="margin: auto;">ارسال</button>
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
    </script>
@endsection