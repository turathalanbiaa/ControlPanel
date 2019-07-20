@extends("layout.main_layout")

@section("title")
    <title> تحويل حساب المستمع الى طالب </title>
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
            <div class="ui segment">
                <h2 class="ui center aligned dividing green header">البيانات المطلوبة لتحويل المستمع الى طالب </h2>
                <div class="ui grid">
                    <div class="ten wide column">
                        <form class="ui large form" method="POST" action="/student/convert-listener-to-student/Validation">
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
                                    <label for="email">البريد الإلكتروني</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="email" value="{{$student->Email}}" name="email" id="email">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="birthdate">تأريخ الميلاد</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="date" value="" name="birthdate" id="birthdate">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="level">المرحلة</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="level" value="" id="level">
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="group">الشعبة</label>
                                </div>
                                <div class="twelve wide field">
                                    <input type="text" value="" name="group" id="group">
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field">
                                    <label for="scientific_degree">الشهادة</label>
                                </div>
                                <div class="twelve wide field">
                                    <div class="ui selection dropdown" tabindex="0" style="width: 100%;">
                                        <input type="hidden" name="scientificDegree" value="" id="scientificDegree">
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
                                    <textarea rows="6" name="address" id="address"></textarea>
                                </div>
                            </div>

                            <div class="inline fields">
                                <div class="four wide field"></div>
                                <div class="twelve wide field">
                                    <button class="ui large green button" type="submit" style="margin: auto;">حفظ التعديلات</button>
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
    </script>
@endsection