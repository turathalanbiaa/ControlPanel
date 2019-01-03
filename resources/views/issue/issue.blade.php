@extends("layout.main_layout")

@section("content")

    <div class="sixteen wide column">
        @include("layout.welcome_to_control_panel")
        <div class="sixteen wide column">
            <div class=" ui grid">
                <div class="six wide column">
                    <div class="ui fluid black large three buttons">
                        <a href="/students/show"  class="ui button">الطلبة</a>
                        <a href="/home"  class="ui button">الرئيسية</a>
                        <a href="/student/create/{{\App\Model\Student\StudentType::LEGAL_STUDENT}}" class="ui button">اضافة طالب</a>
                        <a href="/student/create/{{\App\Model\Student\StudentType::LISTENER}}" class="ui button">اضافة مستمع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="ui horizontal divider header"  style="margin-top: 70px ; margin-bottom: 60px">
        <i class="comment outline icon"></i>
        شكوى او مقترح
    </h4>
    <div class="ui two column grid" style="margin-bottom: 130px">

        <table class="ui right aligned basic table">
            <thead>
            <tr>
                <th>النوع</th>
                <th>العوان</th>
                <th>المحتوى</th>
            </tr>
            </thead> <tbody>
            @foreach($issues as $issue)

                <tr>
                    @if($issue->Title == "1")
                        <td>شكوى</td>
                        @else
                        <td >اقتراح</td>
                        @endif

                    <td style="font-size:large; color: #326758">{{$issue->Type}}</td>
                    <td style="font-size:large">{{$issue->Content}}</td>
                </tr>

            @endforeach
            </tbody>
            </table>
            </div>

<style>

   th{
       font-size:large ;
    }
</style>
@endsection