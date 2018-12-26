@extends("layout.main_layout")

@section("content")
    <div class="ui center aligned grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
            <div class="sixteen wide column">
                <div class=" ui grid">
                    <div class="eight wide column">
                        <form class="ui large form" method="get" action="/students/search" dir="rtl">
                            <div class="ui left icon input" style="width: 100%; text-align: right;">
                                <input type="text" placeholder="بحث عن طالب" name="query" value="" style="text-align: right;">
                                <i class="search icon"></i>
                            </div>

                            <br><br>

                            <div class="inline fields">
                                <label for="option">بحث عن الطالب عن طريق:</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <label for="option">ID</label>
                                        <input type="radio" name="option" value="1" class="hidden">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <label for="option">الاسم</label>
                                        <input type="radio" name="option" value="2" checked="checked" class="hidden">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <label for="option">البريد</label>
                                        <input type="radio" name="option" value="3"  class="hidden">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <label for="option">المرحلة</label>
                                        <input type="radio" name="option" value="4"  class="hidden">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <label for="option">الجنس</label>
                                        <input type="radio" name="option" value="5"  class="hidden">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="six wide column">
                        <div class="ui fluid black large three buttons">
                            <a href="/students/show"  class="ui button">الطلبة</a>

                            <a href="/home"  class="ui button">الرئيسية</a>
                            <a href="/student/create/{{\App\Model\Student\StudentType::LEGAL_STUDENT}}" class="ui button">اضافة طالب</a>
                            <a href="/student/create/{{\App\Model\Student\StudentType::LISTENER}}" class="ui button">اضافة مستمع</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <form class="ui huge form" method="POST" action="/male_message" style="margin-top: 100px">
            {!! csrf_field() !!}
            <div class="inline fields">
                <div class="twelve wide field">
                    <textarea cols="70"  rows="8" name="mymessage" id="mymessage" placeholder="رسالة الى الذكور"></textarea>
                    <button class="ui large green center aligned button" type="submit" style="margin: auto;">ارسال</button>
                </div>
            </div>

        </form>

        <form class="ui huge form" method="POST" action="/female_message">
            {!! csrf_field() !!}
            <div class="inline fields">
                <div class="twelve wide field">
                    <textarea cols="70" rows="8" name="mymessage" id="mymessage" placeholder="رسالة الى الاناث"></textarea>
                    <button class="ui large green center aligned  button" type="submit" style="margin: auto;">ارسال</button>

                </div>
            </div>


        </form>

    </div>
@endsection