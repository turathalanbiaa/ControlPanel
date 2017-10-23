@extends("layout.main_layout")

@section("title")
    <title>انشاء حساب جديد</title>
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

        @if(session("CreateAccountMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("CreateAccountMessage")}}</h2>
                </div>
            </div>
        @endif

        <div class="sixteen wide column">
            <div class="ui segment">
                <h2 class="ui center aligned dividing green header">لأنشاء الحساب المطلوب يرجى ملئ المعلومات الأتية</h2>
                <div class="ui grid">
                    <div class="ten wide column">
                        <form class="ui large form" method="POST" action="/student/create/validation">
                            {!! csrf_field() !!}
                            <input type="hidden" value="{{$accountType}}" name="accountType" id="account-type">

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="name">الأسم الرباعي واللقب</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" value="{{old("name")}}" name="name" id="name">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="email">البريد الإلكتروني</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" value="{{old("email")}}" name="email" id="email">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="password">كلمة المرور</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="password" value="" name="password" id="password">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="password-confirmation">أعد كتابة كلمة المرور</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="password" value="" name="password_confirmation" id="password-confirmation">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="phone">الهاتف</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="tel" value="{{old("phone")}}" name="phone" id="phone">
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
                                                <input type="radio" name="gender" value="{{\App\Model\Student\Gender::MALE}}" tabindex="0" class="hidden" id="gender">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <label>أنثى</label>
                                                <input type="radio" name="gender" value="{{\App\Model\Student\Gender::FEMALE}}" tabindex="0" class="hidden" id="gender">
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
                                        <input type="hidden" name="country" value="{{old("country")}}" id="country">
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

                            @if($accountType == \App\Model\Student\StudentType::LEGAL_STUDENT)
                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="level">المرحلة</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                            <input type="hidden" name="level" value="{{old("level")}}" id="level">
                                            <i class="dropdown icon"></i>
                                            <div class="default text"> أختر مرحلة الطالب </div>
                                            <div class="menu transition hidden" tabindex="-1">
                                                <div class="item" data-value="{{\App\Model\Student\Level::BEGINNER}}">تمهيدي</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::FIRST_LEVEL_INTRO}}">مقدمات مرحلة اولى</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::SECOND_LEVEL_INTRO}}">مقدمات مرحلة ثانية</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::THIRD_LEVEL_INTRO}}">مقدمات مرحلة ثالثة</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::FIRST_LEVEL_UP}}">سطوح مرحلة اولى</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::SECOND_LEVEL_UP}}">سطوح مرحلة ثانية</div>
                                                <div class="item" data-value="{{\App\Model\Student\Level::THIRD_LEVEL_UP}}">سطوح مرحلة ثالثة</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="group">الشعبة</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <input type="text" value="{{old("group")}}" name="group" id="group">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="scientific_degree">الشهادة</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                            <input type="hidden" name="scientific_degree" value="{{old("scientific_degree")}}" id="scientific_degree">
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
                                        <label for="birthdate">تأريخ الميلاد</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <input type="date" value="{{old("birthdate")}}" name="birthdate" id="birthdate">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="four wide field">
                                        <label for="address">العنوان</label>
                                    </div>
                                    <div class="twelve wide field">
                                        <textarea rows="5" name="address" id="address">{{old("address")}}</textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="inline fields">
                                <div class="four wide field"></div>
                                <div class="twelve wide field">
                                    <button class="ui large green button" type="submit" style="margin: auto;">حفظ المعلمومات</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    </script>
@endsection