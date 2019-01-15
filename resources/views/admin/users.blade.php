@extends('layouts.app')
@section('content')
    <div class="card">

        <div class="card-header">Users </div>

        <div class="card-body">

            <table class="table table-borderless table-striped table-hover">
            <thead>
            <tr>
                {{--<th>User Image</th>--}}
                <th>User Name</th>
                <th>User Email</th>
                <th>User Type</th>
                <th>Created Date</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td> <a href="/user/{{$user->id}}/posts">
                        @if($user->user_image)
                            <img src="{{ URL::to('/') }}/uploaded/profile_images/{{$user->user_image}}" class="img-thumbnail mr-1 p-0" style="max-width: 27px;max-height: 27px;padding: 1px !important;" >
                        @endif
                        {{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->type}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                        @if(auth()->user()->id != $user->id)
                        <a href="{{"/users/".$user->id}}" onclick="if(!confirm('Do you Delete This User ?')) return false"> <i class="fa fa-trash"></i></a>
                            @endif
                        </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="pagination col-lg-12 center-block">
            {!! $users->render() !!}
        </div>
    </div>
@endsection
