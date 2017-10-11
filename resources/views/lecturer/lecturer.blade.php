@extends("layout.main_layout")

@section("title")
    <title> الأساتذة </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class=" ui grid">
                <div class="nine wide column">
                    <form class="ui massive form" method="post" action="/lecturers/search" dir="rtl">
                        {!! csrf_field() !!}
                        <div class="ui left icon input" style="width: 100%; text-align: right;">
                            <input type="text" placeholder="بحث عن أستاذ" name="query" style="text-align: right;">
                            <i class="search icon"></i>
                        </div>
                    </form>
                </div>

                <div class="seven wide column">
                    <div class="ui massive orange three equal buttons">
                        <a href="/home" class="ui button">الرئيسية</a>
                        <a href="/lecturer/create" class="ui button">أضافة</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="sixteen wide column">
            @include("lecturer.result_search_lecturer")
        </div>
    </div>
@endsection

@section("script")
    <script>

    </script>
@endsection