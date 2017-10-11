@extends("layout.main_layout")

@section("title")
    <title>الجدول الدراسي</title>
@endsection

@section("content")
    <div class="ui grid">
        <div class="sixteen wide column">
            @include("layout.welcome_to_control_panel")
        </div>

        <div class="sixteen wide column">
            <div class="ui four column grid">
                <div class="column">
                    <a href="/home" class="ui fluid orange big button">الرئيسية</a>
                </div>

                <div class="column">
                    <a href="/timetable/levels" class="ui fluid orange big button">عرض الجداول الدراسية لكل مرحلة</a>
                </div>

                <div class="column">
                    <a href="/timetable/add-lesson/{{$level}}/{{$group}}" class="ui fluid orange big button">اضافة درس الى الجدول الدراسي</a>
                </div>
            </div>
        </div>

        @if($state == 1)
        <div class="sixteen wide column">
            <div class="ui segment">
                <h3 class="ui center aligned green dividing large header">
                    <span>جدول الدراسي للمرحلة </span>
                    <span>{{\App\Model\Student\Level::getLevelName($level)}}</span>
                    <span> - </span>
                    <span>{{$group}}</span>
                </h3>

                <div class="ui inverted segment">
                    <form class="ui big form" method="post" action="/timetable/search">
                        {!! csrf_field() !!}
                        <input type="hidden" name="level" value="{{$level}}">
                        <input type="hidden" name="group" value="{{$group}}">

                        <div class="inline fields">
                            <div class="two wide field">
                                <label for="date" style="color:white;">أختر تأريخ اليوم</label>
                            </div>
                            <div class="six wide field">
                                <input type="date" name="date" id="date">
                            </div>
                            <div class="two wide field">
                                <button type="submit" class="ui fluid big teal button">بحث</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="ui hidden divider"></div>

                <div class="ui segment">
                    <div class="ui grid">
                        <div class="sixteen wide column">
                            <h3 class="ui dividing right aligned green header">
                                <span>دروس اليوم </span>
                                <span>{{'(' . $timetableForToday["Day"] . ')'}}</span>
                                <span>المصادف</span>
                                <span>{{$timetableForToday["Date"]}}</span>
                            </h3>
                        </div>

                        <?php $timetableToday = $timetableForToday["Timetable"]; ?>
                        @if(count($timetableToday) > 0)
                            @foreach($timetableToday as $item)
                                <div class="four wide column">
                                    <button class="ui fluid orange big button">{{$item->Title}}</button>
                                </div>
                            @endforeach
                        @else
                            <div class="sixteen wide column">
                                <div class="ui info big message">
                                    <div class="md-space"></div>
                                    <h3 class="ui center aligned header">لاتوجد دروس لهذا اليوم</h3>
                                    <div class="md-space"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="ui hidden divider"></div>

                <div class="ui segment">
                    <div class="ui grid">
                        <div class="sixteen wide column">
                            <h3 class="ui dividing right aligned green header">
                                <span>دروس يوم غد </span>
                                <span>{{'(' . $timetableForTomorrow["Day"] . ')'}}</span>
                                <span>المصادف</span>
                                <span>{{$timetableForTomorrow["Date"]}}</span>
                            </h3>
                        </div>

                        <?php $timetableTomorrow = $timetableForTomorrow["Timetable"]; ?>
                        @if(count($timetableTomorrow) > 0)
                            @foreach($timetableTomorrow as $item)
                                <div class="four wide column">
                                    <button class="ui fluid orange big button">{{$item->Title}}</button>
                                </div>
                            @endforeach
                        @else
                            <div class="sixteen wide column">
                                <div class="ui info big message">
                                    <div class="md-space"></div>
                                    <h3 class="ui center aligned header">لاتوجد دروس لهذا اليوم</h3>
                                    <div class="md-space"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="ui hidden divider"></div>

                <div class="ui segment">
                    <div class="ui grid">
                        <div class="sixteen wide column">
                            <h3 class="ui dividing right aligned green header">
                                <span>دروس يوم امس </span>
                                <span>{{'(' . $timetableForYesterday["Day"] . ')'}}</span>
                                <span>المصادف</span>
                                <span>{{$timetableForYesterday["Date"]}}</span>
                            </h3>
                        </div>

                        <?php $timetableYesterday = $timetableForYesterday["Timetable"]; ?>
                        @if(count($timetableYesterday) > 0)
                            @foreach($timetableYesterday as $item)
                                <div class="four wide column">
                                    <button class="ui fluid orange big button">{{$item->Title}}</button>
                                </div>
                            @endforeach
                        @else
                            <div class="sixteen wide column">
                                <div class="ui info big message">
                                    <div class="md-space"></div>
                                    <h3 class="ui center aligned header">لاتوجد دروس لهذا اليوم</h3>
                                    <div class="md-space"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($state == 2)
            <div class="sixteen wide column">
                <div class="ui segment">
                    <h3 class="ui center aligned green dividing large header">
                        <span>جدول الدراسي للمرحلة </span>
                        <span>{{\App\Model\Student\Level::getLevelName($level)}}</span>
                        <span> - </span>
                        <span>{{$group}}</span>
                    </h3>

                    <div class="ui inverted segment">
                        <form class="ui big form" method="post" action="/timetable/search">
                            {!! csrf_field() !!}
                            <input type="hidden" name="level" value="{{$level}}">
                            <input type="hidden" name="group" value="{{$group}}">

                            <div class="inline fields">
                                <div class="two wide field">
                                    <label for="date" style="color:white;">أختر تأريخ اليوم</label>
                                </div>
                                <div class="six wide field">
                                    <input type="date" name="date" id="date">
                                </div>
                                <div class="two wide field">
                                    <button type="submit" class="ui fluid big teal button">بحث</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="ui hidden divider"></div>

                    <div class="ui segment">
                        <div class="ui grid">
                            <div class="sixteen wide column">
                                <h3 class="ui dividing right aligned green header">
                                    <span>دروس اليوم </span>
                                    <span>{{'(' . $day . ')'}}</span>
                                    <span>المصادف</span>
                                    <span>{{$date}}</span>
                                </h3>
                            </div>

                            @if(count($timetable) > 0)
                                @foreach($timetable as $item)
                                    <div class="four wide column">
                                        <button class="ui fluid orange big button">{{$item->Title}}</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="sixteen wide column">
                                    <div class="ui info big message">
                                        <div class="md-space"></div>
                                        <h3 class="ui center aligned header">لاتوجد دروس لهذا اليوم</h3>
                                        <div class="md-space"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection