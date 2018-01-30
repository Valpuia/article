  @extends('masters.layout')
  @section('title','Home')
  @section('navbar')
    @parent
  @endsection
  @section('content')

    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-warning">
        <div class="panel-heading">{{Auth::user()->name}}'s Profile</div>
          <div class="panel-body">
            <div class="row">
              <form enctype="multipart/form-data" action="/profileUpdate" method="POST">
                {{csrf_field()}}
                <div class="col-md-4">
                  <center>
                    <img id="blah" src="/ProfilePictures/{{Auth::user()->profilePicture}}" class="img img-thumbnail" style="object-fit:contain; overflow:hidden; height:100px; width:200px;"><br><br>
                  </center>
                  <input id="imgInp" type="file" name="ProfilePictures" class="form-control" accept="image/*">
                </div>
                <div class="col-md-8"><br>
                @if(session('name'))
                  <div class="alert-danger">{{session('name')}}</div>
                @endif
                  <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Name"><br>
                  <input disabled="" type="text" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email"><br>
                @if(session('phone'))
                  <div class="alert-danger">{{session('phone')}}</div>
                @endif
                  <input type="tel" name="phone" value="{{Auth::user()->phone_no}}" class="form-control" placeholder="Phone Number" maxlength="10"><br>
                </div>
            </div>
            <div class="col-md-4 pull-left">
              <input type="submit" value="Save" class="form-control btn-success">
            </div>
            </form>
            <div class="col-md-4 pull-right">
              <a href="/home" class="btn btn-danger form-control">Back</a>
            </div>
          </div>
          </div>
        @if(session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
        @endif
      </div>

@endsection

@section('footer')
  @parent
@endsection