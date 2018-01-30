  @extends('masters.layout')
  @section('title','Home')
  @section('navbar')
    @parent
  @endsection
  @section('content')


    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-warning">
        <div class="panel-heading">{{$poster->name}}'s Profile</div>
        <div class="panel-body">
          <div class="row">
              <div class="col-md-4">
                <img src="/ProfilePictures/{{$poster->profilePicture}}" class="img img-thumbnail" style="object-fit:contain; overflow:hidden; height:200px; width:400px;">
              </div>
              <div class="col-md-8">
                <h4>Name  : {{$poster->name}}</h4>
                <h4>Email&nbsp : {{$poster->email}}</h4>
                <h4>Phone : <a href="tel:{{$poster->phone_no}}"> {{$poster->phone_no}}</a></h4>
                <br><br><br>
                <a href="/home" class="btn btn-warning form-control">Back</a>
              </div>
            </form>
          </div>
        </div>
      </div>

  
@endsection

@section('footer')
  @parent
@endsection