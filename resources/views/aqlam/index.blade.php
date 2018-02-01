@extends("layout.main_layout")

@section("title")
    <title>عرض جميع التدوينات</title>
@endsection

@section("content")
    @include("layout.welcome_to_control_panel")
    @if(session('deletePost'))
        <div class="ui message" style="background-color: #ff393a">
            <p style="font-size: 25px">{{session('deletePost')}}</p>
        </div>
    @endif
    @if(session('UpdateMassage'))
        <div class="ui visible message" style="background-color: #ff393a">
            <p style="font-size: 25px">{{session('UpdateMassage')}}</p>
        </div>
    @endif
<table class="ui compact celled definition table" style="text-align: right">
    <thead>
    <tr>
        <th>عنوان التديونة</th>
        <th>كاتب التدوينة</th>
        <th>التقييم</th>
        <th>عدد التعليقات</th>
        <th>تاريخ التدوينة</th>
        <th>الموافقة على التدوينة</th>
    </tr>
    </thead>
    <tbody>
    @foreach($getPosts as $getPost)
    <tr>
        <td><a href="/aqlam/view/{{$getPost->id}}">{{$getPost->title}}</a> </td>
        <td>{{$getPost->user->name}}</td>
        <td><span class="ui rating" data-rating="{{round($getPost->rate/($getPost->rates->count()+0.1))}}" data-max-rating="5"></span></td>
        <td>{{$getPost->comments->count()}}</td>
        <td>{{$getPost->created_at}}</td>
        @if($getPost->status == 0)
            <td>بلا</td>
        @else
        <td>نعم</td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('.ui.rating').rating('disable');
    });
</script>
@endsection
