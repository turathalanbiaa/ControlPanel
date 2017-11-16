@extends("layout.main_layout")

@section("title")
    <title> لوحة التحكم </title>
@endsection

@section("content")
    <style>
        .ui.button {
            margin: 0;
        }
    </style>
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            @if(session("SuccessRegisterMessage"))
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("SuccessRegisterMessage")}}</h2>
                </div>
            @endif
        </div>

        <style>
            .ui.tag.label, .ui.tag.labels .label
            {
                margin-right: 1em;
                margin-left: 0;
                border-radius: .28571429rem 0  0 .28571429rem !important;
            }

            .ui.tag.label:before, .ui.tag.labels .label:before
            {
                left: 100%;
                right: auto;
                -webkit-transform: translateY(-50%) translateX(-50%) rotate(-45deg);
                transform: translateY(-50%) translateX(-50%) rotate(-45deg);
            }

            .ui.tag.label:after, .ui.tag.labels .label:after
            {
                left: auto;
                right: -.25em;
            }
        </style>
        <div class="sixteen wide column">
            <a class="ui red tag label">Upcoming</a>
        </div>

        <div class="sixteen wide column">
            <div class="ui right aligned four column grid">
                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/StudentsManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['Student']}}">
                            <button type="submit" class="ui fluid massive green button">الطلاب</button>
                        </form>
                    </div>
                </div>

                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/StudentsManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['Lecturer']}}">
                            <button type="submit" class="ui fluid massive purple button">الأساتذة</button>
                        </form>
                    </div>
                </div>

                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/CoursesManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['CoursesAndLessonsAndEExam']}}">
                            <button type="submit" class="ui fluid massive pink button">الدورات والدروس</button>
                        </form>
                    </div>
                </div>

                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/StudentsManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['TimeTable']}}">
                            <button type="submit" class="ui fluid massive green button">جدول الدراسي</button>
                        </form>
                    </div>
                </div>

                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/StudentsManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['Announcement']}}">
                            <button type="submit" class="ui fluid massive pink button">الأعلانات</button>
                        </form>
                    </div>
                </div>

                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/StudentsManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['ShowLecturerMessage']}}">
                            <button type="submit" class="ui fluid massive blue button">عرض الرسائل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.success.message').transition({
                animation  : 'flash',
                duration   : '1.5s'
            });
    </script>
@endsection