@extends("layout.main_layout")

@section("title")
    <title>  معلومات الطالب  </title>
@endsection

@section("content")
    <div class="ui grid">
        {{--<div class="sixteen wide column">--}}
          {{----}}
            {{--@include("layout.welcome_to_control_panel")--}}
        {{--</div>--}}

        <div class="sixteen wide column">
            <div class="ui fluid large  buttons">
                <a href="/home" class="ui button">الرئيسية</a>
                <a href="/students/show" class="ui button">بحث عن طالب</a>
                <a href="/student/change-password/{{$student->ID}}" class="ui button">تغيير كلمة المرور</a>
                <button class="ui button" id="verificationEmail">تفعيل الحساب</button>
                <button class="ui button" id="convertStudentType">تحويل الحساب</button>
                <a href="/student/paper?id={{$student->ID}}" class="ui button">عرض المستمسكات</a>
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

        @if(session("UpdateMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("UpdateMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(session("ChangePasswordMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("ChangePasswordMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(session("VerifiedEmailMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("VerifiedEmailMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(session("ConvertTypeMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("ConvertTypeMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(session("ConvertListenerToStudentMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("ConvertListenerToStudentMessage")}}</h2>
                </div>
            </div>
        @endif
  <img class="ui image" src="http://edu.turathalanbiaa.com/storage/announcement/images/p.jpg" style="width: 100%">
        <div class="centered sixteen wide column">
            <div class="ui segment">
                <h2 class="ui center aligned dividing green header">بيانات الطالب</h2>
                <div class="ui grid">
                    <div class="ten wide column">
                        <form class="ui large form" method="POST" action="/student/update">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ID" value="{{$student->ID}}">

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="name">الأسم الرباعي واللقب</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" value="{{$student->Name}}" name="name" id="name">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="record-number">رقم سجل القيد</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" value="{{$student->RecordNumber}}" name="recordNumber" id="record-number">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="email">البريد الإلكتروني</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" value="{{$student->Email}}" name="email" id="email">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="phone">الهاتف</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" value="{{$student->Phone}}" name="phone" id="phone">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="gender">الجنس</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="inline fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <label>ذكر</label>
                                                <input type="radio" name="gender" value="{{\App\Model\Student\Gender::MALE}}" <?php if($student->Gender == \App\Model\Student\Gender::MALE) echo 'checked="checked"'; ?> tabindex="0" class="hidden" id="gender">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <label>أنثى</label>
                                                <input type="radio" name="gender" value="{{\App\Model\Student\Gender::FEMALE}}" <?php if($student->Gender == \App\Model\Student\Gender::FEMALE) echo 'checked="checked"'; ?> tabindex="0" class="hidden" id="gender">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="country">البلد</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="country" value="{{\App\Model\Student\Country::getCountryName($student->Country)}}" id="country">
                                        <i class="dropdown icon"></i>
                                        <div class="default text"> أختر البلد</div>
                                        <div class="menu transition hidden" tabindex="-1">
                                            <?php $countries= \App\Model\Student\Country::getCountriesList(); ?>
                                            @foreach($countries as $countryCode => $country)
                                                <div class="item" data-value="{{$countryCode}}">{{$country}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($student->Type == \App\Model\Student\StudentType::LEGAL_STUDENT)
                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="birthdate">تأريخ الميلاد</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <input type="date" value="{{$student->Birthdate}}" name="birthdate" id="birthdate">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="level">المرحلة</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                            <input type="hidden" name="level" value="{{\App\Model\Student\Level::getLevelName($student->Level)}}" id="level">
                                            <i class="dropdown icon"></i>
                                            <div class="default text"> مرحلة الطالب </div>
                                            <div class="menu transition hidden" tabindex="-1">
                                                <div class="item" data-value="{{\App\Model\Student\Level::BEGINNER}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::BEGINNER)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::INTRO_FIRST_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_ONE)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::INTRO_FIRST_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_FIRST_PART_TWO)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::INTRO_SECOND_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_ONE)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::INTRO_SECOND_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_SECOND_PART_TWO)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::INTRO_THIRD_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_ONE)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::INTRO_THIRD_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::INTRO_THIRD_PART_TWO)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::SETOH_BEGINNER_PART_ONE}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::SETOH_BEGINNER_PART_ONE)}}</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::SETOH_BEGINNER_PART_TWO}}">{{\App\Model\Student\Level::getLevelName(\App\Model\Student\Level::SETOH_BEGINNER_PART_TWO)}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="group">الشعبة</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <input type="text" value="{{$student->Group}}" name="group" id="group">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="scientific_degree">الشهادة</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                            <input type="hidden" name="scientific_degree" value="{{\App\Model\Student\ScientificDegree::getScientificDegree($student->ScientificDegree)}}" id="scientific_degree">
                                            <i class="dropdown icon"></i>
                                            <div class="default text"> تحصيلك الدراسي</div>
                                            <div class="menu transition hidden" tabindex="-1">
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::RELIGION}}">حوزوي</div>
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::INTERMEDIATE_SCHOOL}}">متوسطة</div>
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::HIGH_SCHOOL}}">أعدادية</div>
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::DIPLOMA}}">دبلوم</div>
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::BACHELORS}}">بكالوريوس</div>
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::MASTER}}">دراسات عليا</div>
                                                <div class="item" data-value="{{\App\Model\Student\ScientificDegree::PHD}}">دكتوراه</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="address">العنوان</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <textarea rows="6" name="address" id="address">{{$student->Address}}</textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="inline fields">
                                <div class="four wide field"></div>
                                <div class="twelve wide field">
                                    <button class="ui large  button" type="submit" style="margin: auto;">حفظ التعديلات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("extra-content")
    {{--verification Email Modal--}}
    <div class="ui modal" id="verificationEmailModal">
        <div class="ui right aligned inverted header" style="background-color: teal; color: white;">يمكن تفعيل الحساب بطريقتين</div>
        <div class="content">
            <form class="ui form" method="post" action="/mail/verification-email" style="text-align: center;">
                {!! csrf_field() !!}
                <input type="hidden" name="studentId" value="{{$student->ID}}">
                <input type="hidden" name="type" value="1">
                <button type="submit" class="ui large orange button" style="width: 300px;">ارسال رسالة التفعيل الى بريد الطالب الإلكتروني</button>
            </form>

            <div class="ui hidden divider"></div>

            <form class="ui form" method="post" action="/mail/verification-email" style="text-align: center;">
                {!! csrf_field() !!}
                <input type="hidden" name="studentId" value="{{$student->ID}}">
                <input type="hidden" name="type" value="2">
                <button type="submit" class="ui large orange button" style="width: 300px;">تفعيل حساب اطالب</button>
            </form>
        </div>
    </div>

    {{--Convert Student Type Modal--}}
    <div class="ui modal" id="converStudentTypeModal">
        <div class="ui right aligned inverted header" style="background-color: teal; color: white;"><span>تحويل حساب الطالب </span><span>{{$student->Name}}</span></div>
        <div class="content">
            <form class="ui form" method="post" action="/student/convert-type" style="text-align: center;">
                {!! csrf_field() !!}
                <input type="hidden" name="studentId" value="{{$student->ID}}">
                <h3 class="ui brown header">اذا كنت تريد تحويل الحساب</h3>
                <button type="submit" class="ui large green button" style="width: 300px;">اضغط هنا</button>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.radio.checkbox').checkbox();
        $('.ui.selection.dropdown').dropdown();
        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });

        $('#verificationEmail').click(function ()
        {
            $('#verificationEmailModal.ui.modal').modal('show');
        });

        $('#convertStudentType').click(function ()
        {
            $('#converStudentTypeModal.ui.modal').modal('show');
        });
    </script>
@endsection

