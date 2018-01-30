  @extends('masters.layout')
  @section('title','Home')
  @section('navbar')
    @parent
  @endsection
  @section('content')


              @if(session('verified'))
                <div class="alert-success">{{session('verified')}}</div>
              @endif

  @if(count($articles) != 0) 
    <div class="col-md-3">
      <div class="list-group">
        @foreach($articles as $article)
        <li class = "list-group-item">
          <div data-toggle="collapse" data-id="scroll" data-parent="#accordion" data-target="#collapse{{$article->id}}" class="btn form-control scroll-link">
            {{$article->title}}
          </div>
          <br>
          <div class="text-center">
            @if(Auth::user()->id==$article->user_id)
              By <a href="/user">{{$article->user->name}}</a>
            @else
              By <a href="/{{$article->user->name}}/profile">{{$article->user->name}}</a>
            @endif
          </div>
        </li>
        @endforeach
      </div>
      <center>
      {{ $articles->links() }}
      </center>

      @if(session('error'))
      <div class="alert-danger">{{session('error')}}
      </div>
    @endif
    @if(session('success'))
      <div class="alert-success">{{session('success')}}
      </div>
    @endif
    </div>
    <div class="col-md-9" id="scroll">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default x">
          <div id="collapse{{ $article->id }}" class="panel-collapse collapse in">
            <div class="panel-body">
              <h2 class="text-center"><u>{{$article->title}}</u></h2>
                {!! nl2br($article->content) !!}
            </div>
          </div>
          @foreach($posts as $posts)
              <div id="collapse{{ $posts->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                  <h2 class="text-center"><u>{{$posts->title}}</u></h2>
                    {!! nl2br($posts->content) !!}
                 </div>
              </div>
          @endforeach
        </div>
      </div>
    </div>
    
    @else
    <div class="col-md-3">
      <div class="list-group">
        <li class = "list-group-item">
          <br>
          <div class="text-center">
              No posts yet, Go to <a href="/newarticle">new article</a> to post new or go to <a href="/home">home</a>
          </div>
          </li>
      </div>
    </div>
    @endif
@endsection

@section('footer')
  @parent
@endsection
