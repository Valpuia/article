  @extends('masters.layout')
  @section('title','Home')
  @section('navbar')
    @parent
  @endsection
  @section('content')

  @if(count($mynewarticle) != 0) 

    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-warning line">
        <div class="panel-heading">{{Auth::user()->name}}'s articles</div>
          <div class="panel-body">
            <div class="table-responsive">          
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Posted At</th>
                    <th>Updated At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
              <tbody>
              @foreach($mynewarticle as $mynewarticle)
              <tr>
                <td>{{$mynewarticle->title}}</td>
                  <td>{{Carbon\Carbon::parse($mynewarticle->created_at)->diffForHumans()}}</td>
                  <td>{{Carbon\Carbon::parse($mynewarticle->updated_at)->diffForHumans()}}</td>
                  <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$mynewarticle->id}}">Edit</button></td>
                  <td>
                    <form method="POST" action="/Delete">
                      {{csrf_field()}}
                      <input type="hidden" name="del" value="{{$mynewarticle->id}}">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myDeleteModal{{$mynewarticle->id}}">Delete</button>
                    </form>
                  </td>
                </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
            <center>
              {{$mynewarticles->links()}}
            </center>
    </div>


  @foreach($mynewarticles as $mynewarticles)
  <div id="myModal{{$mynewarticles->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <form method="POST" action="/myarticle">
      {{csrf_field()}}
        <input type="hidden" name="id" value="{{$mynewarticles->id}}">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5>Title</h5>
              <input type ="text" value="{{$mynewarticles->title}}" name="title" placeholder="Title (Max is 30 character)" maxlength="30" required class="form-control">
            </div>
            <div class="modal-body">
            <h5>Article</h5>
              <textarea required name="content" class="form-control" rows="15">{!! $mynewarticles->content !!}</textarea>
            </div>
            <div class="modal-footer">
              <input type="submit" value="Save" class="btn btn-primary pull-left">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
            </div>
          </div>
      </form>
    </div>
  </div>
  @endforeach

  @foreach($mynewarticles1 as $mynewarticles)
  <div id="myDeleteModal{{$mynewarticles->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you sure you want to delete</h4>
        </div>
        <div class="modal-footer">
          <form method="POST" action="/Delete">
            {{csrf_field()}}
            <input type="hidden" name="del" value="{{$mynewarticles->id}}">
            <input type="submit" value="Yes" class="btn btn-primary pull-left">
          </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

    @else
    <div class="col-md-8 col-md-offset-2">
      <div class="list-group">
        <li class = "list-group-item">
          <br>
          <div class="text-center">
              You don't have any post yet!, Go to <a href="/newarticle">new article</a> to post new or go to <a href="/home">home</a>
          </div>
          </li>
      </div>
    </div>
    @endif
  

@endsection

@section('footer')
  @parent
@endsection