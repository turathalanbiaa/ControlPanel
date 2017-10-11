@extends("layout.main_layout")

@section("title")
    <title>{{$course->Name}}</title>
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
                    <form method="post" action="/lessons/search">
                        {!! csrf_field() !!}
                        <input type="hidden" name="query" value="">
                        <button type="submit" class="ui fluid big orange button">بحث عن درس</button>
                    </form>
                </div>

                <div class="column">
                    <a href="/lesson/create" class="ui fluid big orange button">أضافة درس</a>
                </div>

                <div class="column">
                    <a href="/courses/groups" class="ui fluid big orange button">المراحل</a>
                </div>
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
                <h1 class="ui center aligned dividing green header">جميع دروس {{$course->Name}}</h1>
                @foreach($course->Lessons as $lesson)
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