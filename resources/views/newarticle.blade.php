  @extends('masters.layout')
  @section('title','Home')
  @section('navbar')
    @parent
  @endsection
  @section('content')


    <div class="col-md-8 col-md-offset-2">
    
      <div class="panel panel-primary">
        <div class="panel-heading text-center">New Article</div>
          <div class="panel-body">
            <form method="post" action="/newarticle">
            {{csrf_field()}}
                <div class="form-group">
                  <label for="inputdefault">Title</label>
                  <input required class="form-control" id="inputdefault" type="text" name="title" placeholder="Title (Maximum is 30 character)" maxlength="30">
                </div>
                <div class="form-group">
                  <label for="inputlg">Article</label>
                  <textarea required class="form-control" rows="14" name="article"></textarea>
                </div>
                <div class= "col-md-3 pull-left">
                    <input class="btn btn-primary form-control" type="submit" value="submit" name="submit">
                </div>
                <div class= "col-md-3 pull-right">
                  <a href="/home" class="btn btn-danger form-control">Cancel</a>
                </div>
            </form>
          </div>
      </div>
    </div>
  
@endsection

@section('footer')
  @parent
@endsection