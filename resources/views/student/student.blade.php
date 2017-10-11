@extends("layout.main_layout")

@section("content")
    <style>
        .ui.form .inline.fields>label
        {
            margin: .035714em 0.5em 0 1em;
        }

        .ui.form .inline.fields .field
        {
            padding: 0 0 0 1em;
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

        <div class="sixteen wide column">
            <div class=" ui grid">
                <div class="ten wide column">
                    <form class="ui big form" method="get" action="/students/search" dir="rtl">
                        <div class="ui left icon input" style="width: 100%; text-align: right;">
                            <input type="text" placeholder="بحث عن طالب" name="query" style="text-align: right;">
                            <i class="search icon"></i>
                        </div>

                        <br><br>

                        <div class="inline fields">
                            <label for="option">بحث عن الطالب عن طريق:</label>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <label for="option">الاسم</label>
                                    <input type="radio" name="option" value="1" checked="checked" class="hidden">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <label for="option">البريد</label>
                                    <input type="radio" name="option" value="2"  class="hidden">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="six wide column">
                    <div class="ui fluid orange big three buttons">
                        <a href="/home"  class="ui button">الرئيسية</a>
                        <a href="/student/create/{{\App\Model\Student\StudentType::LEGAL_STUDENT}}" class="ui button">اضافة طالب</a>
                        <a href="/student/create/{{\App\Model\Student\StudentType::LISTENER}}" class="ui button">اضافة مستمع</a>
                    </div>
                </div>
            </div>
        </div>

        @if(session("ChooseAccountMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("ChooseAccountMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(session("DeleteMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("DeleteMessage")}}</h2>
                </div>
            </div>
        @endif

        @if(session("InfoMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("InfoMessage")}}</h2>
                </div>
            </div>
        @endif

        <div class="sixteen wide column">
            @include("student.result_search_student")
        </div>

        @if(isset($pagesCount))
            <div class="sixteen wide column">
                <div class="ui segment">
                    <div class="ui right aligned big teal label">
                        <span>عدد الصفحات</span>
                        <div class="detail">{{$pagesCount}}</div>
                    </div>
                    <div class="ui hidden divider"></div>
                    <?php
                    $colors = ["red","orange","yellow","olive","green","teal","blue","violet","purple","pink","brown","grey","black"];

                    echo '<div class="ui circular large labels"'.'style="text-align: center;">';
                    for ($i = 1; $i <= $pagesCount; $i++)
                    {
                        $index = rand(0,12);
                        $color = $colors[$index];
                        echo '<a href="/students/show?page_num='.$i.'" class="ui '.$color.' label">'.$i.'</a>';
                    }
                    echo '</div>';
                    ?>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("extra-content")
    <div class="ui modal">
        <h1 class="ui right aligned red header"> هل تريد حذف هذه الطالب </h1>
        <div class="content" style="text-align: center;">
            <h3 class="ui center aligned teal header" id="student-name"></h3>
            <div class="ui divider"></div>
            <form class="ui form" method="post" action="/student/delete">
                {!! csrf_field() !!}
                <input type="hidden" name="studentID" value="">
                <button type="submit" class="ui green button">نعم</button>
                <a class="ui red button" id="abort">لا</a>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.radio.checkbox').checkbox();

        $("button[data-action='delete-student']").click(function ()
        {
            var studentId = $(this).data('id');
            var studentName = $(this).data('content');
            $('h3#student-name').text(studentName);
            $('input[name=studentID]:hidden').val(studentId);

            $('.ui.modal').modal('show');
        });

        $('#abort').click(function ()
        {
            $('.ui.modal').modal('hide');
        });

        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });
    </script>
@endsection