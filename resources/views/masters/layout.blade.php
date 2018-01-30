<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{URL::to('/')}}/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    .x{
        height: 525px;
        overflow-y: scroll; 
      }
    </style>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body><br>
  @section('navbar')

    <div class ="col-md-12">
      <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="navbar-brand" href="/user">
                <span>
                  <img src="{{URL::to('/')}}/ProfilePictures/{{Auth::user()->profilePicture}}" class="img img-circle" style="object-fit:contain; overflow:hidden; height:30px; width:30px;">
                </span>
                  {{ Auth::user()->name}}
              </a>

            </div>
            <div class="navbar-nav col-md-3">

                  <form class="navbar-form" method="Get" action="/home">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search username or title" name="search">
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                          <i class="glyphicon glyphicon-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>

            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="/home">Home</a></li>
                <li><a href="/newarticle">New Article</a></li>
                <li><a href="/myarticle">My Articles</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
              </ul> 
            </div>
          </div>
          </nav>
        </div>
@show
@yield('content')
@section('footer')
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{URL::to('/')}}/js/bootstrap.min.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/user.js"></script>
  </body>
</html>
@show