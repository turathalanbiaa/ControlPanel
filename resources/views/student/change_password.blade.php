@extends("layout.main_layout")

@section("title")
    <title>  تغيير كلمة المرور  </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
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
            <div class="ui center aligned one column grid">
                <div class="column">
                    <div style="background-color: #FFFAF3;">
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
                                                <button class="ui orange large button" type="submit">حفظ</button>
                                                <a href="/student/info-{{$student->ID}}" class="ui orange large button">رجوع</a>
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

@section("script")
    <script>
        $('.ui.form')
            .form({
                on: 'blur',
                fields: {
                    password: {
                        identifier: 'password',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'يرجى أدخال كلمة المرور.'
                            },
                            {
                                type   : 'minLength[6]',
                                prompt : 'يجب ان تكون كلمة المرور لا تقل عن {ruleValue} حروف.'
                            }
                        ]
                    },
                    password_confirmation: {
                        identifier: 'password_confirmation',
                        rules: [
                            {
                                type   : 'empty',
                                prompt : 'يرجى أدخال كلمة المرور.'
                            },
                            {
                                type   : 'minLength[6]',
                                prompt : 'يجب ان تكون كلمة المرور لا تقل عن {ruleValue} حروف.'
                            },
                            {
                                type   : 'match[password]',
                                prompt : 'كلمتا المرور غير متطابقتان.'
                            }

                        ]
                    }
                }
            })
        ;
    </script>
@endsection