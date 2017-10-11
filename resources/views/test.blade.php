@extends("layout.main_layout")

@section("content")

    <form action="/test" method="post">
        {!! csrf_field() !!}
        <input type="text" name="filed"/>
        <button  name="x" >Emad</button>
        <button  name="x" >Aii</button>
    </form>

    <script>

    </script>

@endsection