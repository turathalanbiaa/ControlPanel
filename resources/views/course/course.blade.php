@extends("layout.main_layout")

@section("title")
    <title> الدورات </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class=" ui grid">
                <div class="nine wide column">
                    <form class="ui big form" method="post" action="/courses/search" dir="rtl">
                        {!! csrf_field() !!}
                        <div class="ui left icon input" style="width: 100%; text-align: right;">
                            <input type="text" placeholder="بحث عن دورة..." name="query" style="text-align: right;">
                            <i class="search icon"></i>
                        </div>
                    </form>
                </div>

                <div class="seven wide column">
                    <div class="ui big orange three equal buttons">
                        <a href="/home" class="ui button">الرئيسية</a>
                        <a href="/course/create" class="ui button">اضافة دورة</a>
                        <a href="/courses/groups" class="ui button">المراحل الدراسية </a>
                    </div>
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
            @include("course.result_search_course")
        </div>
    </div>
@endsection

@section("extra-content")
    <div class="ui modal">
        <h1 class="ui right aligned red header"> هل تريد حذف هذه الدورة </h1>
        <div class="content" style="text-align: center;">
            <h3 class="ui center aligned teal header" id="course-name"></h3>
            <div class="ui divider"></div>
            <form class="ui form" method="post" action="/course/delete">
                {!! csrf_field() !!}
                <input type="hidden" name="courseID" value="">
                <a class="ui red button" id="abort">لا</a>
                <button type="submit" class="ui green button">نعم</button>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });

       $("button[data-action='delete-course']").click(function ()
       {
          var courseId = $(this).data('id');
          var courseName = $(this).data('content');
          $('h3#course-name').text(courseName);
          $('input[name=courseID]:hidden').val(courseId);

          $('.ui.modal').modal('show');
       });

        $('#abort').click(function ()
        {
            $('.ui.modal').modal('hide');
        });
    </script>
@endsection