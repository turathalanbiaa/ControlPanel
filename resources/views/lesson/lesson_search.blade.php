@extends("layout.main_layout")

@section("title")
    <title>بحث عن درس</title>
@endsection

@section("content")
    <style>
        .ui.vertical.segment {
            display: flex;
        }

        .ui.vertical.segment > .header
        {
            width: 50%;
        }

        .ui.vertical.segment > .content
        {
            width: 20%;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .ui.vertical.segment > .extra-content
        {
            width: 30%;
        }

        .ui.statistics {
            margin-top: 13px !important;
        }

        .ui.buttons {
            margin-top: 25px;
        }

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
            <div class="ui five column grid">
                <div class="column">
                    <a href="/home" class="ui fluid big orange button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/courses/show" class="ui fluid big orange button">بحث عن دورة</a>
                </div>

                <div class="column">
                    <a href="/course/create" class="ui fluid big orange button">أضافة دورة</a>
                </div>

                <div class="column">
                    <a href="/lesson/create" class="ui fluid big orange button">أضافة درس</a>
                </div>

                <div class="column">
                    <a href="/courses/groups" class="ui fluid big orange button">المراحل</a>
                </div>
            </div>
        </div>

        <div class="sixteen wide column">
            <div class=" ui grid">
                <div class="ten wide column">
                    <form class="ui big form" method="post" action="/lessons/search" dir="rtl">
                        {!! csrf_field() !!}
                        <div class="ui left icon input" style="width: 100%; text-align: right;">
                            <input type="text" placeholder="بحث عن درس..." name="query" style="text-align: right;">
                            <i class="search icon"></i>
                        </div>
                        <br><br>
                        <div class="inline fields">
                            <label for="option">بحث عن الدرس عن طريق:</label>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <label for="option">ID</label>
                                    <input type="radio" name="option" value="1" class="hidden">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <label for="option">اسم الدرس</label>
                                    <input type="radio" name="option" value="2" checked="checked"  class="hidden">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="six wide column"></div>
            </div>
        </div>

        @if(session("DeleteMessage"))
            <div class="sixteen wide column">
                <div class="ui success large message">
                    <h2 style="text-align: center;">{{session("DeleteMessage")}}</h2>
                </div>
            </div>
        @endif

        <div class="sixteen wide column">
            <div class="ui segment">
                <h1 class="ui center aligned dividing green header">نتائج البحث </h1>

                @if($state == 0)
                    <div class="ui massive info message">
                        <div class="lg-space"></div>
                        <h1 class="ui center aligned info header">لاتوجد نتائج</h1>
                        <div class="lg-space"></div>
                    </div>
                @endif

                @if($state == 1)
                    @foreach($lessons as $lesson)
                        <div class="ui vertical segment">
                            <div class="header">
                                <div class="ui inverted circular segment" style="width: 492px;">
                                    <h2 class="ui inverted header">
                                        <a href="/lesson/info-{{$lesson->ID}}">{{$lesson->Title}}</a>
                                        <div class="sub header">{{$lesson->VideoLength}}</div>
                                    </h2>
                                </div>
                            </div>
                            <div class="content">
                                <div class="ui small statistics">
                                    <div class="ui small statistic">
                                        <div class="label">عدد المشاهدات</div>
                                        <div class="value">
                                            {{count($lesson->views)}}
                                        </div>
                                    </div>

                                    <div class="ui small statistic">
                                        <div class="label">عدد التعليقات</div>
                                        <div class="value">
                                            {{count($lesson->comments)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="extra-content">
                                <div class="ui huge fluid buttons">
                                    <a class="ui orange button" href="/e-exam/add-question/{{$lesson->ID}}">أضافة سؤال</a>
                                    <a class="ui green button" href="/lesson/info-{{$lesson->ID}}"> عرض</a>
                                    <button class="ui red button" data-action="delete-lesson" data-id="{{$lesson->ID}}" data-content="{{$lesson->Title}}">حذف</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection

@section("extra-content")
    <div class="ui modal">
        <h1 class="ui right aligned red header"> هل تريد حذف هذا الدرس </h1>
        <div class="content" style="text-align: center;">
            <h3 class="ui center aligned teal header" id="lesson-title"></h3>
            <div class="ui divider"></div>
            <form class="ui form" method="post" action="/lesson/delete">
                {!! csrf_field() !!}
                <input type="hidden" name="lessonID" value="">
                <a class="ui red button" id="abort">لا</a>
                <button type="submit" class="ui green button">نعم</button>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.ui.radio.checkbox').checkbox();

        $("button[data-action='delete-lesson']").click(function ()
        {
            var lessonId = $(this).data('id');
            var lessonTitle = $(this).data('content');
            $('h3#lesson-title').text(lessonTitle);
            $('input[name=lessonID]:hidden').val(lessonId);

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