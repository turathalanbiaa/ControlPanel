
@extends('layout.main_layout')
@section('content')
    @include("layout.welcome_to_control_panel")
<form class="ui form" method="post" action="/library/upload_book" enctype="multipart/form-data" style="margin-top: 5%; margin-bottom: 1%">
    {!! csrf_field() !!}
    <div class="field">
        <label>عنوان الكتاب</label>
        <input id="inp-title" autocomplete="off" name="title" type="text" list="title" required />
        <datalist id="title">
            @foreach($booksNames as $bookName)
                <option value="{{$bookName->BookName}}"></option>
            @endforeach
        </datalist>
    </div>
    <div class="field">
        <label>التصنيف</label>
        <select class="ui fluid dropdown" name="category" required>
            @foreach($getCategories as $category)
                <option value="{{$category->Category}}">{{$category->Category}}</option>
            @endforeach
        </select>
    </div>

    <button class="positive ui button" type="submit">اضافة الكتب</button>
</form>
@endsection