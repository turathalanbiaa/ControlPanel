@extends("layout.main_layout")

@section("title")
    <title>الجدول الدراسي</title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui segment">
                <div class="ui grid">
                    <div class="eight wide column">
                        <div class="lg-space"></div>
                        <form class="ui big form" method="get" action="/timetable/operations">
                            {!! csrf_field() !!}

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label>المرحلة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" style="width: 100%;">
                                        <input type="hidden" name="level">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">اختر المرحلة</div>
                                        <div class="menu">
                                            <div class="item" data-value="{{\App\Model\Student\Level::BEGINNER}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::BEGINNER)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::FIRST_LEVEL_INTRO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::FIRST_LEVEL_INTRO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::SECOND_LEVEL_INTRO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::SECOND_LEVEL_INTRO)}}</div>
                                            <div class="item" data-value="{{\App\Model\Student\Level::THIRD_LEVEL_INTRO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::THIRD_LEVEL_INTRO)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="three wide field">
                                    <label>الشعبة</label>
                                </div>
                                <div class="thirteen wide field">
                                    <div class="ui selection dropdown" style="width: 100%;">
                                        <input type="hidden" name="group">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">اختر المرحلة</div>
                                        <div class="menu">
                                            <div class="item" data-value="شعبة أ">{{"شعبة أ"}}</div>
                                            <div class="item" data-value="شعبة ب">{{"شعبة ب"}}</div>
                                            <div class="item" data-value="شعبة ج">{{"شعبة ج"}}</div>
                                            <div class="item" data-value="شعبة هـ">{{"شعبة هـ"}}</div>
                                            <div class="item" data-value="شعبة و">{{"شعبة و"}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ui hidden divider"></div>

                            <div class="inline fields">
                                <div class="sixteen wide field">
                                    <button type="submit" class="ui big green button" name="send" value="pre-add-lessons" style="margin: auto;">ارسال</button>
                                </div>
                            </div>
                        </form>
                        <div class="lg-space"></div>
                    </div>
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
        $('.ui.form').form({
            fields: {
                level: {rules: [{type   : 'empty'}]},
                group: {rules: [{type   : 'empty'}]}
            }
        });
    </script>
@endsection