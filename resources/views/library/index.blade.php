@extends("layout.main_layout")
@section("title")
    <title>عرض جميع الكتب</title>
@endsection
@section('content')
    @include("layout.welcome_to_control_panel")
    @if(session('Message'))
        <div class="ui message" style="background-color: #ff393a">
            <p style="font-size: 25px">{{session('Message')}}</p>
        </div>
    @endif
    <a href="/library/add_book" class="positive ui button" style="margin-top: 5%">اضافة كتاب</a>
    <table class="ui compact celled definition table" style="text-align: right">
        <thead>
        <tr>
            <th>عنوان الكتاب</th>
            <th>المؤلف</th>
            <th>التصنيف</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($getAllBooks as $book)
            <tr>
                <td><a href="{{asset('storage/'.$book->No.'.pdf')}}">{{$book->BookName}}</a></td>
                <td>{{$book->AuthorID}}</td>
                <td>{{$book->CategoryID}}</td>
                <td><input type="button" class="ui red button approve delete" name="{{$book->No}}" value="حذف"/></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="ui mini modal" id="post_modal" style="text-align: right">
        <div class="header" style="color: #00aeef">حذف الكتاب</div>
        <div class="content">
            <p style="font-size: 20px">سوف يتم حذف الكتاب بعد الضغط على كلمة موافق</p>
        </div>
        <div class="actions">
            <form method="post" action="/library/destroy_book">
                {!! csrf_field() !!}
                <input type="hidden" class="delete-book" name="delete_book" value="">
                <button type="submit" value="حذف" class="ui red button approve">موافق</button>
                <div class="ui cancel button cancel">الغاء</div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.delete').click(function ()
            {
                $('.mini.modal').modal('show');
                var del = $(this).attr('name');
                $('.delete-book').val(del);
            });
        });
    </script>
    {{$getAllBooks->links()}}
@endsection