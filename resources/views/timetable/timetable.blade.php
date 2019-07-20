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
            <div class="ui fluid black large four buttons">
                <a href="/home"  class="ui button">الرئيسية</a>
                <a href="/timetable/pre-add-lessons" class="ui button">اضافة دروس الى الجدول الدراسي</a>
                <a href="/timetable/pre-update-lessons" class="ui button">تعديل دروس الجدول الدراسي</a>
                <a href="/timetable/show-timetable-for-levels" class="ui button">عرض الجداول الدراسية</a>
            </div>
        </div>

        <div  class="sixteen wide column">
            <div class="ui segment">
                <h3 class="ui dividing center aligned green header">البحث عن جميع الدروس ضمن الفترة المحددة</h3>
                <form class="ui big form" method="post" action="/timetable/search">
                    {!! csrf_field() !!}

                    <div class="fields">
                        <div class="four wide field">
                            <label for="level">المرحلة</label>
                            <div class="ui selection dropdown" style="width: 100%;">
                                <input type="hidden" name="level" id="level">
                                <i class="dropdown icon"></i>
                                <div class="default text">اختر المرحلة</div>
                                <div class="menu">
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

                        <div class="four wide field">
                            <label for="group">الشعبة</label>
                            <div class="ui selection dropdown" style="width: 100%;">
                                <input type="hidden" name="group" id="group">
                                <i class="dropdown icon"></i>
                                <div class="default text">اختر الشعبة</div>
                                <div class="menu">
                                    <div class="item" data-value="شعبة أ">{{"شعبة أ"}}</div>
                                    <div class="item" data-value="شعبة ب">{{"شعبة ب"}}</div>
                                    <div class="item" data-value="شعبة ج">{{"شعبة ج"}}</div>
                                    <div class="item" data-value="شعبة هـ">{{"شعبة هـ"}}</div>
                                    <div class="item" data-value="شعبة د">{{"شعبة د"}}</div>
                                    <div class="item" data-value="شعبة و">{{"شعبة و"}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="three wide field">
                            <label for="from-date">من تأريخ</label>
                            <input type="date" name="fromDate" id="from-date">
                        </div>

                        <div class="three wide field">
                            <label for="to-date">الى تأريخ</label>
                            <input type="date" name="toDate" id="to-date">
                        </div>

                        <div class="two wide field">
                            <label></label><br>
                            <button type="submit" class="ui fluid big green button"  style="margin: auto !important;">بحث</button>
                        </div>
                    </div>
                </form>

                <div class="ui hidden divider"></div>

                @if(isset($results))
                    <div class="ui dividing header">نتائج البحث</div>
                    @if(count($results) > 0)
                        <table class="ui center aligned celled large table">
                            <thead>
                            <tr>
                                <th>اليوم</th>
                                <th>التاريخ</th>
                                <th>عدد الدروس</th>
                                <th>خيارات</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{\App\Model\Main\Date::getArabicDay($result->Date)}}</td>
                                    <td>{{$result->Date}}</td>
                                    <td>{{$result->CountOfLessons}}</td>
                                    <td><a href="/timetable/operations?level={{$level}}&group={{$group}}&date={{$result->Date}}&send=pre-update-lessons" class="ui green button">عرض</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="ui massive message">
                            <div class="lg-space"></div>
                            <h2 class="ui center aligned header">لاتوجد دروس خلال هذه الفترة الزمنية</h2>
                            <div class="lg-space"></div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.selection.dropdown').dropdown();
        $('.ui.form').form({
            fields: {
                level: {rules: [{type   : 'empty'}]},
                group: {rules: [{type   : 'empty'}]},
                fromDate: {rules: [{type   : 'empty'}]},
                toDate: {rules: [{type   : 'empty'}]}
            }
        });
    </script>
@endsection