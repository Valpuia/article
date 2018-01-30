<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body><br><br>
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-info">
        <div class="panel-heading text-center">Welcome to Registration Page</div>
          <div class="panel-body">
            <form method="post" action="/register">
              {{ csrf_field()}}
              @if(session('name'))
                <div class="alert-danger">{{session('name')}}</div>
              @endif
              <input class="form-control" required="" type="text" name="name" placeholder="Name"><br>
              @if(session('email'))
                <div class="alert-danger">{{session('email')}}</div>
              @endif
              <input class="form-control" required="" type="email" name="email" placeholder="Email">
              <br>
              @if(session('passwords'))
                <div class="alert-danger">{{session('passwords')}}</div>
              @endif
              <input class="form-control" required type="password" name="password" placeholder="Password"><br>
              @if(session('password'))
                <div class="alert-danger">{{session('password')}}</div>
              @endif
              <input class="form-control" required type="password" name="password_confirmation" placeholder="Confirm Password"><br>
              @if(session('phone'))
                <div class="alert-danger">{{session('phone')}}</div>
              @endif
              <input class="form-control" required type="tel" name="phone" placeholder="Mobile number" maxlength="10"><br>
              <input class="btn btn-success pull-right" type="submit" value="Register">
              <a href="/" class="btn btn-danger pull-left">Cancel</a>
            </form>
          </div>
        </div>
    </div>
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>