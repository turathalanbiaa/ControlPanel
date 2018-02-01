@extends('layout.main_layout')
@section('content')
    @include("layout.welcome_to_control_panel")
    @if ($errors->any())
        <div class="ui red message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="ui form" method="post" action="/aqlam/post_edit" style="margin-top: 5%; margin-bottom: 1%">
        {!! csrf_field() !!}
        <div class="field">
            <label>عنوان التدوينة</label>
            <textarea rows="2" name="title">{{$getPost->title}}</textarea>
        </div>
        <div class="field">
            <label>نص التدوبنة</label>
            <textarea rows="40" name="content">{{$getPost->content}}</textarea>
        </div>
        <input type="hidden" name="post_id" value="{{$getPost->id}}">
        <button class="positive ui button" type="submit">تعديل التدوينة</button>
    </form>
@endsection