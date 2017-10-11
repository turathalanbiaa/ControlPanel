@extends("layout.main_layout")

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui massive success message">
                <div class="ui center aligned header">{{$message}}</div>
                <div class="sm-space"></div>
                <div class="content" style="text-align: center">
                    <a class="ui large center aligned orange button" href="/student/show-all-student">رجوع الى صفحة الطلاب</a>
                </div>
            </div>
        </div>
    </div>
@endsection