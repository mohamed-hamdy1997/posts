@extends('layouts.app')
@section('content')

            <div class="content">
                <div class="container">
                <h1>Posts</h1>

@if(count($posts) >0)

 <div class="row container">
    @foreach($posts as $post)
  <div class="col-sm-4">
  
  <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{{$post->title}}</h3>
  </div>
  <div class="panel-body mh-100">
    <p>{{substr($post->body,0,50)}}</p>

      @if($post->post_image)
 <img src="{{ URL::to('/') }}/uploaded/images/{{$post->post_image}}" class="img-thumbnail" alt="{{$post->post_image}}" style="width:65%;max-height:130px" >
      @endif

   <span class="label label-danger">created at : {{$post->created_at}}  </span>
     <span class="label label-info">  by {{$post->user->name}}</span>

      <a href="/posts/{{$post->id}}/view" class="float-right">View Post</a>

  </div>
</div>
  
  </div>
   
  @endforeach


</div>

</div>
 
</div>
            {{$posts->links()}}

@else


<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oh  !</strong> <a href="#" class="alert-link">No posts !</a> and try submitting again.
</div>



@endif

           @endsection



 

