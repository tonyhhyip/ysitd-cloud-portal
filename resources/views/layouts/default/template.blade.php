@section('title', isset($title) ? $title : 'Dashboard')
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') | YSITD Cloud Portal</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css">
    <link href="{{ url("/css/app.min.css") }}" rel="stylesheet" type="text/css">
    <!--[if lte IE 8]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body id="vue-root">
<header>
@include('layouts/default/header')
@include('layouts/default/nav')
</header>
<main>
    <div class="container">
    @yield('content')
    </div>
</main>
@include('layouts/default/footer')
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.0/react.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/react/15.3.0/react-dom.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/classnames/2.2.5/dedupe.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/vue-material-components/0.3.4/vue-material-components.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.9.3/vue-resource.min.js"></script>
<script defer src="{{ url('js/common.min.js') }}"></script>
<script defer src="{{ url('js/app.min.js') }}"></script>
@yield('scripts')
</body>
</html>
