@extends("layout.main_layout")

@section("title")
    <title> معلومات الأستاذ </title>
@endsection

@section("content")
    <style>
        .ui.button
        {
            margin: 0;
        }

        .ui.inverted.segment
        {
            min-height: 425px;
        }

        .my-list
        {
            font-size: 16px;
            color: white;
        }

        .my-list > li > a
        {
            color: white;
            font-size: 18px;
        }
    </style>
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        @if(isset($NotFoundLecturer))
            <div class="sixteen wide column">
                <div class="ui info massive message">
                    <div class="lg-space"></div>
                    <h2 class="ui center aligned info large header">{{$NotFoundLecturer}}</h2>
                    <div class="sm-space"></div>
                    <h3 class="ui center aligned header">
                        <a href="/lecturer/show" class="ui orange button">رجوع الى صفحة الأساتذة</a>
                    </h3>
                    <div class="lg-space"></div>
                </div>
            </div>
        @else
            <div class="sixteen wide column">
                <div class="ui segment">
                    <div class="ui right aligned grid">
                        <div class="eight wide column">
                            <form class="ui large form" method="post" action="/lecturer/update">
                                <h2 class="ui center aligned dividing header">بيانات الأستاذ</h2>
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{$lecturer->ID}}">

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label for="name">اسم الأستاذ</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="name" value="{{$lecturer->Name}}" id="name">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label for="email">البريد الإلكتروني</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="email" name="email" value="{{$lecturer->Email}}" id="email">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label for="phone">الهاتف</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="phone" value="{{$lecturer->Phone}}" id="phone">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label for="scientificDegree">الشهادة</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <input type="text" name="scientificDegree" value="{{$lecturer->ScientificDegree}}" id="scientificDegree">
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="three wide field">
                                        <label for="description">الوصف</label>
                                    </div>
                                    <div class="thirteen wide field">
                                        <textarea rows="5" style="resize: none;" name="description" id="description">{{$lecturer->Description}}</textarea>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <button type="submit" class="ui teal large button" style="margin: auto;">حفظ التعديلات</button>
                                </div>
                            </form>
                        </div>
                        <div class="eight wide column">
                            <h2 class="ui center aligned dividing header">معلومات أخرى</h2>
                            <div class="ui inverted segment">
                                @if($courses->count() == 0)
                                    <div class="ui massive info message">
                                        <div class="sm-space"></div>
                                        <h3 class="ui center aligned header">هذا الأستاذ لايعطي اي دورة</h3>
                                        <div class="sm-space"></div>
                                    </div>
                                @else
                                    <h2 class="ui center aligned dividing teal header">الدورات التي يعطيها الأستاذ</h2>
                                    <div class="ui hidden divider"></div>
                                    <ol class="my-list">
                                        @foreach($courses as $course)
                                            <li><a href="/course/info-{{$course->ID}}">{{$course->Name}}</a> </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("script")
    <script>
        $('.success.message').transition({
            animation  : 'flash',
            duration   : '1.5s'
        });
    </script>
@endsection