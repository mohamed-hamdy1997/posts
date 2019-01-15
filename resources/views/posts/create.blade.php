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

     <form action="/create" method="post" enctype="multipart/form-data">
         {{csrf_field()}}

         <div class="form-group">
               <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{Request::old('title')}}">
         </div>

         <div class="form-group">
             <label>Post Body</label>
             <textarea name="body" id="article-ckeditor" cols="30" rows="10" placeholder="Post Body" class="form-control">{{Request::old('body')}}</textarea>
         </div>

         <div class="form-group col-md-4">
             <label>Image</label>
             <input type="file" name="post_image" class="form-control" >
         </div>

         <div class="form-group col-md-4">
             <label>Video</label>
             <input type="file" name="post_video" class="form-control">
         </div>

         <div class="form-group col-md-4">
             <label>File</label>
             <input type="file" name="post_file" class="form-control">
         </div>

         <input type="submit" class="btn btn-primary btn-lg" value="Create">

</form>
   </div>

    
           @endsection



 

