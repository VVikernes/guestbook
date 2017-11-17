<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
</head>

<body>

{{--<div class="blog-masthead">--}}
{{--<div class="container">--}}
{{--<nav class="blog-nav">--}}
{{--@yield('navigation')--}}
{{--</nav>--}}
{{--</div>--}}
{{--</div>--}}

<div class="container">

    <div class="blog-header">
        <div class="blog-title-parent">
            <a href="{{ route('index') }}" class="h-link"><h1 class="blog-title">Guestbook</h1></a>
        </div>
    </div>

    <div class="row">
        @yield('baseContent')
                <!-- /.blog-main -->
    </div>
    <!-- /.container -->

    <div class="blog-footer">
        <p>
            <a href="#">Back to top</a>
        </p>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/app.js"></script>
    <script src="/js/docs.min.js"></script>
@yield('javascript')
</body>
</html>