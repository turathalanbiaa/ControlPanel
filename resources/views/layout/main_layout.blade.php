<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield("title")

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheet -->
    <link href="{{asset('assets/styles/semantic.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/styles/style.css')}}" rel="stylesheet" type="text/css">

    <!-- Script -->
    <script src="{{asset("assets/scripts/jquery.min.js")}}"></script>
    <script src="{{asset("assets/scripts/semantic.min.js")}}"></script>

</head>
<body>
    <div class="ui container">
        @yield("content")
    </div>

    @yield("extra-content")

    @yield("script")
</body>
</html>
