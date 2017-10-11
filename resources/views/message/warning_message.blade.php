@extends("layout.main_layout")

@section("title")
    <title>تحذير دخول</title>
@endsection

@section("content")

    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui massive error message">
                <div class="ui center aligned header">
                    <img class="ui warning image" src="{{asset("assets/images/Warning.png")}}" style="width: 250px; height: 250px; margin: auto;">
                    <p>دخول خاطأ لايمكنك الوصول الى هذه الصفحة لانه ليس لديك الأذن بالوصول</p>
                    <p>أرجو عدم تكرار هذا الدخول</p>
                    <a href="/" class="ui orange large button">الصفحة الرئيسية</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script>
        $('.warning.image').transition({
            animation  : 'shake',
            duration   : '1s'
        });
    </script>
@endsection