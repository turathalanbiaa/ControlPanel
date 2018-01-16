@extends("layout.main_layout")

@section("title")
    <title>المراحل الدراسية</title>
@endsection
@section('content')
<div class="ui grid">
    <div class="sixteen wide column">
        @include("layout.welcome_to_control_panel")
    </div>
    @if(session('DeleteComment'))
        <div class="ui message" style="background-color: #ff393a">
            <p style="font-size: 25px">{{session('DeleteComment')}}</p>
        </div>
    @endif
    <div class="eleven wide column">
       <img src="http://aqlam.turathalanbiaa.com/aqlam/image/{{$getPost->image}}" style="width: 100%">
    </div>
    <div class="eleven wide column">
       <h3>{{$getPost->title}}</h3>
    </div>
    <div class="row">
        <div class="one wide column">
            <img src="{{asset('avatar.png')}}">
        </div>
        <div class="four wide column">
            <p>{{$getPost->user->name}}</p>
        </div>
    </div>
    <div class="row">
        <div class="sixteen wide column">
            <p>{{$getPost->content}}</p>
        </div>
    </div>
    <div class="row">
        <form method="post" action="/aqlam/post_confirm">
            {!! csrf_field() !!}
            <input type="hidden" name="post_confirm" value="{{$getPost->id}}">
            <button class="positive ui button">قبول التدوية</button>
        </form>
        <button class="primary ui button">تعديل التدوينة</button>
        <button class="negative ui button" id="delete_post">حذف التدوينة</button>
    </div>
</div>
<div class="ui two column grid">
    <div class="column">
        <div class="ui piled blue segment">
            <h2 class="ui header">
                <i class="icon inverted circular blue comment"></i> التعليقات
            </h2>
            @foreach($getComments as $comment)
            <div class="ui comments">
                <div class="comment">
                    <a class="avatar" style="float: right; margin-left: 0.2em">
                        <img src="{{asset('avatar.png')}}">
                    </a>
                    <div class="content">
                        <a class="author">{{$comment->user->name}}</a>
                        <div class="metadata">
                            <span class="date">{{$comment->created_at}}</span>
                        </div>
                        <div class="text">
                            {{$comment->content}}
                        </div>
                        <div class="actions">
                            <button  class="ui red button delete" name="{{$comment->id}}" >حذف</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="ui mini modal" id="comment-id" style="text-align: right">
    <div class="header" style="color: #00aeef">حذف تعليق</div>
    <div class="content">
        <p style="font-size: 20px">سوف يتم حذف التعليق بعد الضغط على كلمة موافق</p>
    </div>
    <div class="actions">
        <form method="post" action="/aqlam/comment_destroy">
            {!! csrf_field() !!}
            <input type="hidden" id="input_val" name="delete" value="">
            <button type="submit" value="حذف" class="ui red button approve">حذف</button>
            <div class="ui cancel button cancel">الغاء</div>
        </form>
    </div>
</div>
<div class="ui mini modal" id="post_modal" style="text-align: right">
    <div class="header" style="color: #00aeef">حذف تعليق</div>
    <div class="content">
        <p style="font-size: 20px">سوف يتم حذف التدوينة بعد الضغط على كلمة موافق</p>
    </div>
    <div class="actions">
        <form method="post" action="/aqlam/post_destroy">
            {!! csrf_field() !!}
            <input type="hidden" name="delete_post" value="{{$getPost->id}}">
            <button type="submit" value="حذف" class="ui red button approve">حذف</button>
            <div class="ui cancel button cancel">الغاء</div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete').click(function ()
        {
            $('#comment-id').modal('show');
            var del = $(this).attr('name');
            $('#input_val').val(del);
        });
        $('#delete_post').click(function ()
        {
            $('#post_modal').modal('show')
        })
    });
</script>
@endsection