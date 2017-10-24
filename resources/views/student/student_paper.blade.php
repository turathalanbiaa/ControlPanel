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
                                <img class="ui fluid image" src="{{asset("/assets/images/Courses.jpg")}}">
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
                                    <button class="ui fluid inverted yellow button" data-action="show">عرض</button>
                                </div>
                                <div class="column">
                                    <div class="ui fluid inverted green button">قبول</div>
                                </div>
                                <div class="column">
                                    <div class="ui fluid inverted blue button">رفض</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="ui top attached header">التزكية الدينية</div>
                        <div class="ui attached segment">
                            @if(!empty($papers["2"]))
                                <img class="ui fluid image" src="{{asset("/assets/images/Courses.jpg")}}">
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
                                    <button class="ui fluid inverted yellow button" data-action="show">عرض</button>
                                </div>
                                <div class="column">
                                    <div class="ui fluid inverted green button">قبول</div>
                                </div>
                                <div class="column">
                                    <div class="ui fluid inverted blue button">رفض</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="ui top attached header">الشهادة العلمية</div>
                        <div class="ui attached segment">
                            @if(!empty($papers["3"]))
                                <img class="ui fluid image" src="{{asset("/assets/images/Courses.jpg")}}">
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
                                    <button class="ui fluid inverted yellow button" data-action="show">عرض</button>
                                </div>
                                <div class="column">
                                    <div class="ui fluid inverted green button">قبول</div>
                                </div>
                                <div class="column">
                                    <div class="ui fluid inverted blue button">رفض</div>
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
    </script>
@endsection