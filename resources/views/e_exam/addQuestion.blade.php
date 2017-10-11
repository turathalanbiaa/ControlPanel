@extends("layout.main_layout")

@section("title")
    <title>{{$lesson->Title}}</title>
@endsection

@section("content")
    <style>
        .ui.radio.checkbox {
            width: 125px;
        }
        .ui.radio.checkbox label
        {
            padding-right: 1.85714em;
            padding-left: 0;
        }

        .ui.radio.checkbox label:before,
        .ui.radio.checkbox label:after
        {
            right: 0;
        }
    </style>
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        @if(isset($NotFoundLesson))
            <div class="sixteen wide column">
                <div class="ui massive info message">
                    <div class="lg-space"></div>
                    <h1 class="ui center aligned info header">{{$NotFoundLesson}}</h1>
                    <div class="lg-space"></div>
                </div>
            </div>
        @else
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
                    <h2 class="ui center aligned dividing green header"> أضافة سؤال الى الدرس  <span>{{"(" . $lesson->Title . ")"}}</span> </h2>
                    <table class="ui right aligned inverted brown big cell table">
                        <thead>
                        <tr>
                            <th>الفقرة</th>
                            <th>القيمة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>اسم الدورة</td>
                            <td>{{$lesson->Course->Name}}</td>
                        </tr>
                        <tr>
                            <td>اسم الدرس</td>
                            <td>{{$lesson->Title}}</td>
                        </tr>
                        <tr>
                            <td>عدد الأسلة حول الدرس</td>
                            <td>{{count($lesson->EExamQuestion)}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <form class="ui big form" method="post" action="/e-exam/add-question/validation">
                        {!! csrf_field() !!}
                        <input type="hidden" name="lessonID" value="{{$lesson->ID}}">

                        <div class="field">
                            <label for="question">السؤال</label>
                            <textarea rows="5" name="question" id="question" style="margin-top: 10px;"></textarea>
                        </div>

                        <div class="field">
                            <label for="address">الأختيارات</label>
                            <div class="ui segment">
                                <div class="inline fields">
                                    <div class="two wide field">
                                        <label>الأختيار الأول</label>
                                    </div>
                                    <div class="six wide field">
                                        <input type="text" name="option-1" value="">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="two wide field">
                                        <label>الأختيار الثاني</label>
                                    </div>
                                    <div class="six wide field">
                                        <input type="text" name="option-2" value="">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="two wide field">
                                        <label>الأختيار الثالث</label>
                                    </div>
                                    <div class="six wide field">
                                        <input type="text" name="option-3" value="">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="two wide field">
                                        <label>الأختيار الرابع</label>
                                    </div>
                                    <div class="six wide field">
                                        <input type="text" name="option-4" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label>أختر رقم الجواب الصحيح</label>
                            <div class="ui segment">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="answer" value="1" checked="checked" class="hidden">
                                    <label>الأختيار الأول</label>
                                </div>
                                <div class="ui radio checkbox">
                                    <input type="radio" name="answer" value="2" class="hidden">
                                    <label>الأختيار الثاني</label>
                                </div>
                                <div class="ui radio checkbox">
                                    <input type="radio" name="answer" value="3" class="hidden">
                                    <label>الأختيار الثالث</label>
                                </div>
                                <div class="ui radio checkbox">
                                    <input type="radio" name="answer" value="4" class="hidden">
                                    <label>الأختيار الرابع</label>
                                </div>
                            </div>
                        </div>

                        <div class="eight wide field" style="margin: auto;">
                            <button type="submit" class="ui fluid huge green button">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("script")
    <script>
        $('.ui.radio.checkbox').checkbox();
    </script>
@endsection