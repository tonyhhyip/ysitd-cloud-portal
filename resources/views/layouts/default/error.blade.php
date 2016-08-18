<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') | YSITD Cloud Portal</title>
    <link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css">
    <link href="{{ url("/css/app.min.css") }}" rel="stylesheet" type="text/css">
    <!--[if lte IE 8]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <style>
        footer,main{padding: 0;margin: 0;}
        body{background-color:#44A148;}
        footer.page-footer{position:relative;border-top:3px white solid;background-color: #2ea9e2;}
        img {width:auto;height:300px;margin:auto;}
    </style>
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col l6 m12 s24">
                <h1 class="white-text">@yield('title')</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col m12 s24">
                <div class="card medium z-depth-5">
                    <div class="card-content text-strong">
                        @yield('content')
                        <div class="card-image">
                            <img src="{{ url('images/sitcon-lady.png') }}" style="width: auto;height: 300px;">
                        </div>
                        @yield('action')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s18">
                <h4 class="text-white white-text left">YSITD Cloud Portal</h4>
            </div>
            <div class="col l6 s18">
                <a href="https://github.com/ysitd/ysitd-cloud-portal" class="right">
                    <span class="fa fa-github"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            &copy; 2016 YSITD
        </div>
    </div>
</footer>
</body>
</html>
