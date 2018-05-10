@extends("layout.main_layout")

@section("title")
    <title> دليل الصائم </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui grid">
                <div class="thirteen wide column">
                    <form class="ui form" method="get" action="" dir="rtl">
                        <div class="ui left icon input" style="width: 100%; text-align: right;">
                            <input type="text" placeholder="بحث عن مدينة" value="@if(isset($_GET["query"])) {{$_GET["query"]}} @endif" name="query" style="text-align: right;">
                            <i class="search icon"></i>
                        </div>
                    </form>
                </div>

                <div class="three wide column">
                    <a class="ui fluid orange button" href="/daleel-alsaam/add">أضافة يوم جديد</a>
                </div>
            </div>
        </div>

        <div class="sixteen wide column">
            <table class="ui celled center aligned table">
                <thead>
                <tr>
                    <th>الرقم</th>
                    <th>المدينة</th>
                    <th>اليوم اسماً</th>
                    <th>اليوم رقماً</th>
                    <th>الشهر</th>
                    <th>يوم رمضان</th>
                    <th>وقت الامساك</th>
                    <th>صلاة الصبح</th>
                    <th>صلاة الظهر</th>
                    <th>صلاة المغرب</th>
                    <th>خيارات</th>
                </tr>
                </thead>

                <tbody>
                @if(count($rows) > 0)
                    @foreach($rows as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->city}}</td>
                            <td>{{$row->dayName}}</td>
                            <td>{{$row->dayOfMonth}}</td>
                            <td>{{$row->monthOfYear}}</td>
                            <td>{{$row->ramadanDay}}</td>
                            <td>{{$row->imsak}}</td>
                            <td>{{$row->fajir}}</td>
                            <td>{{$row->duhr}}</td>
                            <td>{{$row->mogrhib}}</td>
                            <td><button class="ui red button" data-action="delete" data-id="{{$row->id}}">حذف</button></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section("extra-content")
    <div class="ui mini modal">
        <h3 class="ui center aligned top attached grey inverted header">
            <span>هل انت متأكد من حذف هذا اليوم!!!</span>
        </h3>
        <div class="content">
            <div class="ui hidden divider"></div>

            <h3 class="ui center aligned header">
                <span>رقم اليوم - </span>
                <span id="number"></span>
            </h3>

            <div class="ui divider"></div>

            <div class="actions" style="text-align: center;">
                <button class="ui positive button">نعم</button>
                <button class="ui negative button">لا</button>
            </div>

            <div class="ui hidden divider"></div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        $("button[data-action='delete']").click(function () {
            var button = $(this);
            button.parent().parent().attr("id", "row-delete");
            button.addClass("loading");
            $("#number").html(button.data("id"));
            $(".modal")
                .modal({
                    'closable' : false,
                    'transition': 'horizontal flip'
                })
                .modal("show");
        });

        $("button.positive.button").click(function () {
            var _token = "{{ csrf_token() }}";
            var id = $("#number").html();
            var success = false;

            $.ajax({
                type: "POST",
                url: "/daleel-alsaam/delete",
                data: {_token:_token, id:id},
                datatype: 'json',
                success: function(result) {
                    if (result["notFound"] == true)
                        snackbar("هذا اليوم غير موجود." , 3000 , "warning");

                    else if (result["success"] == false)
                        snackbar("لم يتم حذف اليوم, يرجى اعدة المحاولة." , 3000 , "error");

                    else if (result["success"] == true)
                    {
                        snackbar("تم حذف اليوم." , 3000 , "success");
                        success = true;
                    }
                },
                error: function() {
                    snackbar("تحقق من الاتصال بالانترنت" , 3000 , "error");
                } ,
                complete : function() {
                    var tr = $("#row-delete");
                    tr.removeAttr("id");
                    tr.find("button").removeClass("loading");
                    if(success)
                    {
                        setTimeout(function () {
                            tr.addClass("scale");
                            tr.transition({
                                animation  : 'scale',
                                duration   : '1s'
                            });

                        }, 250);
                    }
                }
            });
        });

        $("button.negative.button").click(function () {
            var tr = $("#row-delete");
            tr.removeAttr("id");
            tr.find("button").removeClass("loading");
        });
    </script>
@endsection