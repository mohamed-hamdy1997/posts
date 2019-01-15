@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class=container>

        <form action="{{action('PostsController@update',$post->id)}}" method="post" enctype="multipart/form-data" class="col-md-7">
            {{csrf_field()}}

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}">
            </div>

            <div class="form-group">
                <label>Post Body</label>
                <textarea name="body" id="article-ckeditor" cols="30" rows="10" placeholder="Post Body" class="form-control">{{$post->body}}</textarea>
            </div>

            <div class="form-group col-md-4">
                <label>Image</label>
                <input type="file" name="post_image" class="form-control"  value="{{$post->post_image}}">
            </div>

            <div class="form-group col-md-4">
                <label>Video</label>
                <input type="file" name="post_video" class="form-control" value="{{$post->post_video}}">
            </div>

            <div class="form-group col-md-4">
                <label>File</label>
                <input type="file" name="post_file" class="form-control"  value="{{$post->post_file}}">
            </div>

            <input type="submit" class="btn btn-primary btn-lg" value="Update">

        </form>

        <div class="col-md-5">
            @if($post->post_image)
                <img src="{{ URL::to('/') }}/uploaded/images/{{$post->post_image}}" class="img-thumbnail" alt="{{$post->post_image}}" style="width:50%;height:50%" >
            @endif

            @if($post->post_video)

                <video width="320" height="240" controls>
                    <source src="{{ URL::to('/') }}/uploaded/videos/{{$post->post_video}}" type="video/mp4">
                    <source src="{{ URL::to('/') }}/uploaded/videos/{{$post->post_video}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            @endif

            @if($post->post_file)
                <a href="{{ URL::to('/') }}/uploaded/files/{{$post->post_file}}">{{$post->post_file}}</a>
            @endif

        </div>
    </div>


@endsection





