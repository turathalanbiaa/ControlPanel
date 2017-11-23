@extends("layout.main_layout")

@section("title")
    <title> المستمسكات </title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui segment">
                <h3 class="ui dividing right aligned green header"><span>مستمسكات الطالب :- </span> <span>{{$student->Name}}</span></h3>
                <div class="ui center aligned three column grid">
                    <div class="column">
                        <div class="ui top attached header">الهوية الشخصية</div>
                        <div class="ui attached segment">
                            @if(!empty($papers["1"]))
                                <img class="ui fluid image" src="http://turathalanbiaa.com/storage/student/paper/{{$papers["1"]->Image}}">
                            @else
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <h3 style="padding: 8px 0;">لم يقم الطالب برفع هذا المستمسك</h3>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                            @endif
                        </div>
                        <div class="ui bottom attached inverted segment">
                            <div class="ui three column grid">
                                <div class="column">
                                    <button class="ui fluid inverted yellow button @if(empty($papers['1'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['1'])) {{"data-action=show"}} @endif>
                                        <span>عرض</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="ui fluid inverted green button @if(empty($papers['1'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['1'])) {{"data-action=accept"}} {{"data-paper-id=" . $papers["1"]->ID}} @endif>
                                        <span>قبول</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="ui fluid inverted blue button @if(empty($papers['1'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['1'])) {{"data-action=reject"}} {{"data-paper-id=" . $papers["1"]->ID}} @endif>
                                        <span>رفض</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="ui top attached header">التزكية الدينية</div>
                        <div class="ui attached segment">
                            @if(!empty($papers["2"]))
                                <img class="ui fluid image" src="http://turathalanbiaa.com/storage/student/paper/{{$papers["2"]->Image}}">
                            @else
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <h3 style="padding: 8px 0;">لم يقم الطالب برفع هذا المستمسك</h3>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                            @endif
                        </div>
                        <div class="ui bottom attached inverted segment">
                            <div class="ui three column grid">
                                <div class="column">
                                    <button class="ui fluid inverted yellow button @if(empty($papers['2'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['2'])) {{"data-action=show"}} @endif>
                                        <span>عرض</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="ui fluid inverted green button @if(empty($papers['2'])) {{"disabled"}} @endif"
                                        @if(!empty($papers['2'])) {{"data-action=accept"}} {{"data-paper-id=" . $papers["2"]->ID}} @endif>
                                        <span>قبول</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="ui fluid inverted blue button @if(empty($papers['2'])) {{"disabled"}} @endif"
                                        @if(!empty($papers['2'])) {{"data-action=reject"}} {{"data-paper-id=" . $papers["2"]->ID}} @endif>
                                        <span>رفض</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="ui top attached header">الشهادة العلمية</div>
                        <div class="ui attached segment">
                            @if(!empty($papers["3"]))
                                <img class="ui fluid image" src="http://turathalanbiaa.com/storage/student/paper/{{$papers["3"]->Image}}">
                            @else
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <h3 style="padding: 8px 0;">لم يقم الطالب برفع هذا المستمسك</h3>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                                <div class="sm-space"></div>
                            @endif
                        </div>
                        <div class="ui bottom attached inverted segment">
                            <div class="ui three column grid">
                                <div class="column">
                                    <button class="ui fluid inverted yellow button @if(empty($papers['3'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['3'])) {{"data-action=show"}} @endif>
                                        <span>عرض</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="ui fluid inverted green button @if(empty($papers['3'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['3'])) {{"data-action=accept"}} {{"data-paper-id=" . $papers["3"]->ID}} @endif>
                                        <span>قبول</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <button class="ui fluid inverted blue button @if(empty($papers['3'])) {{"disabled"}} @endif"
                                    @if(!empty($papers['3'])) {{"data-action=reject"}} {{"data-paper-id=" . $papers["3"]->ID}} @endif>
                                        <span>رفض</span>
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("extra-content")
    <div class="ui modal">
        <div class="ui segment" style="height: 750px;">
            <img class="ui fluid image" style="height: 720px;" src="">
        </div>
    </div>
@endsection

@section("script")
    <script>
        $("button[data-action='show']").click(function ()
        {
            var image = $(this).parent().parent().parent().parent().find(".ui.fluid.image");
            var src = image.attr("src");
            $('.ui.modal').find('.ui.fluid.image').attr("src",src);
            $('.ui.modal').modal("show");
        });

        $("button[data-action='accept']").click(function ()
        {
            var paperId = $(this).data("paper-id");

            $.ajax({
                type: "GET",
                url: '/student/paper/accept',
                data: {paperId: paperId},
                datatype: 'json',
                success: function(result) {
                    if (result["success"] == null)
                    {
                        snackbar("لاتوجد هذه المستمسكات !!!، اعد المحاولة مرة اخرى." , 3000 , "warning");
                    }

                    if (result["success"] == false)
                    {
                        snackbar("لم تتم عملية قبول المستمسك , يرجى اعادة المحاولة." , 3000 , "warning");
                    }

                    if (result["success"] == true)
                    {
                        snackbar("تمت عملية قبول المستمسك بنجاح" , 3000 , "warning");
                    }
                },
                error: function() {
                    snackbar("تحقق من الاتصال بالانترنت" , 3000 , "warning");
                } ,
                complete : function() {
                    dimmer.removeClass("active");
                }
            });
        });

        $("button[data-action='reject']").click(function ()
        {
            var paperId = $(this).data("paper-id");

            $.ajax({
                type: "GET",
                url: '/student/paper/reject',
                data: {paperId: paperId},
                datatype: 'json',
                success: function(result) {
                    if (result["success"] == null)
                    {
                        snackbar("لاتوجد هذه المستمسكات !!!، اعد المحاولة مرة اخرى." , 3000 , "warning");
                    }

                    if (result["success"] == false)
                    {
                        snackbar("لم تتم عملية رفض المستمسك , يرجى اعادة المحاولة." , 3000 , "warning");
                    }

                    if (result["success"] == true)
                    {
                        snackbar("تمت عملية رفض المستمسك بنجاح" , 3000 , "warning");
                    }
                },
                error: function() {
                    snackbar("تحقق من الاتصال بالانترنت" , 3000 , "warning");
                } ,
                complete : function() {
                    dimmer.removeClass("active");
                }
            });
        });
    </script>
@endsection