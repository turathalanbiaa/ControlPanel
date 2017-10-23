@extends("layout.main_layout")

@section("title")
    <title>  تغيير كلمة المرور  </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui fluid large black buttons">
                <a href="/home" class="ui button">الرئيسية</a>
                <a href="/students/show" class="ui button">بحث عن طالب</a>
                <a href="/student/info-{{$student->ID}}" class="ui button">عرض معلومات الطالب</a>
                <a href="/student/create/{{\App\Model\Student\StudentType::LEGAL_STUDENT}}" class="ui button">اضافة طالب</a>
                <a href="/student/create/{{\App\Model\Student\StudentType::LISTENER}}" class="ui button">اضافة مستمع</a>
            </div>
        </div>

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
            <div class="ui one column grid">
                <div class="column">
                    <div class="ui segment">
                        <h2 class="ui center aligned dividing green header">{{$student->Name}}</h2>
                        <div class="lg-space"></div>
                        <div class="ui center aligned grid">
                            <div class="twelve wide column">
                                <form class="ui large form" method="post" action="/student/change-password/validation">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="ID" value="{{$student->ID}}">

                                    <div class="inline fields">
                                        <div class="four wide field">
                                            <label for="password">كلمة المرور الجديدة</label>
                                        </div>
                                        <div class="twelve wide field">
                                            <input type="password" name="password" id="password">
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="four wide field">
                                            <label for="password_confirmation">أعد كتابة كلمة المرور</label>
                                        </div>
                                        <div class="twelve wide field">
                                            <input type="password" name="password_confirmation" id="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="four wide field"></div>
                                        <div class="twelve wide field">
                                            <div style="width:100%; margin: auto;">
                                                <button class="ui green large button" type="submit">حفظ</button>
                                                <a href="/student/info-{{$student->ID}}" class="ui green large button">رجوع</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui error message" id="message"></div>
                                </form>
                            </div>
                        </div>
                        <div class="lg-space"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection