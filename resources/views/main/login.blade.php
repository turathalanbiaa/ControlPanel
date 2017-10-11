@extends("layout.main_layout")

@section("title")
    <title> تسجيل الدخول الى لوحة التحكم </title>
@endsection

@section("content")
    <style>

    </style>
    <div class="ui center aligned grid">
        <div class="eight wide column">
            <div class="lg-space"></div>
            <div class="lg-space"></div>

            @if(count($errors))
                <div class="ui error message" id="message">
                    <ul class="list">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session("ErrorRegisterMessage"))
                <div class="ui error message" id="message">
                    <ul class="list">
                        <li>{{session("ErrorRegisterMessage")}}</li>
                    </ul>
                </div>
            @endif

            <form class="ui login big form" method="post" action="/login-validation">
                {!! csrf_field() !!}
                <div class="field">
                    <label for="username">اسم المستخدم</label>
                    <input type="text"  name="username" id="username">
                </div>
                <div class="field">
                    <label for="password">كلمة المرور</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="ui submit big orange button">دخول</button>
            </form>

            <div class="lg-space"></div>
            <div class="lg-space"></div>
        </div>
    </div>
@endsection