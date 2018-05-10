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

                <div class="column">
                    <div class="special card">
                        <div class="special image">
                            <img src="{{asset("assets/images/StudentsManager.png")}}">
                        </div>

                        <form class="ui form" method="post" action="/redirect">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="{{$_SESSION["USER_TYPE"]}}">
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['Aqlam']}}">
                            <button type="submit" class="ui fluid massive green button">أقلام</button>
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
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['Library']}}">
                            <button type="submit" class="ui fluid massive green button">المكتبة</button>
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
                            <input type="hidden" name="map" value="{{\App\Model\Main\Map::MAPS['Daleel_Alsaam']}}">
                            <button type="submit" class="ui fluid massive green button">دليل الصائم</button>
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