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
    @if(session('Message'))
        <div class="ui green message">
            <p>{{session('Message')}}</p>
        </div>
    @endif
    <form class="ui form" method="post" action="/library/upload_book" enctype="multipart/form-data" style="margin-top: 5%; margin-bottom: 1%">
        {!! csrf_field() !!}
        <div class="field">
            <label>عنوان الكتاب</label>
            <input id="inp-title" autocomplete="off" name="title" type="text" list="title" />
            <datalist id="title">
                @foreach($booksNames as $bookName)
                <option value="{{$bookName->BookName}}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="field">
            <label>التصنيف</label>
            <select class="ui fluid dropdown" name="category">
                @foreach($getCategories as $category)
                    <option value="{{$category->Category}}">{{$category->Category}}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label>اجزاء الكتاب</label>
            <select class="ui fluid dropdown" name="volume">
                <option value="">بلا</option>
                <option value="1">الاول</option>
                <option value="2">الثاني</option>
                <option value="3">الثالث</option>
                <option value="4">الرابع</option>
                <option value="5">الخامس</option>
                <option value="6">السادس</option>
                <option value="7">السابع</option>
                <option value="8">الثامن</option>
                <option value="9">التاسع</option>
                <option value="10">العاشر</option>
            </select>
        </div>
        <div class="field">
            <label>المؤلف</label>
            <input type="text" name="author" placeholder="المؤلف">
        </div>
        <div class="field">
            <label>دار النشر</label>
            <input type="text" name="publication" placeholder="دار النشر">
        </div>
        <div class="field">
            <label>الكتاب</label>
            <input type="file" name="book" placeholder="الكتاب">
        </div>
        <button class="positive ui button" type="submit">اضافة الكتاب</button>
    </form>
    <a href="/library" class="fluid ui button">الرجوع لى القائمة الرئيسية </a>
    <script>
        $('.dropdown').dropdown();
    </script>
@endsection