<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeekQuiz</title>
    
    <script src="{{ URL::asset('javascript/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ URL::asset('javascript/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('javascript/handlebars.js') }}"></script>    
    <script src="{{ URL::asset('javascript/ember-1.0.0.debug.js') }}"></script>    
    <script src="{{ URL::asset('javascript/modernizr-2.6.2.js') }}"></script>
    <script src="{{ URL::asset('javascript/respond.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/flip.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/Site.css') }}">
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ Url::to('/')}}" class="navbar-brand">GeekQuiz</a>
                <!-- @ Html.ActionLink("GeekQuiz", "Index", "Home", null, new { @ class = "navbar-brand" })-->
                
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ Url::to('/')}}" >Play</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container body-content">
        @yield('content')
        <hr />
        <footer>
            &copy; <?= date("Y") ?> Geek Quiz Ltd.
        </footer>
    </div>

    <script>
        try {
            if (App && App.Router && App.Router.reopen) {
                App.Router.reopen({
                    location: 'none'
                });
            }
        }
        catch (e) { // intentional
             
        }
    </script>
</body>
</html>