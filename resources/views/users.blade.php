@extends('layouts.master')

@section('title', $title )

@section('header')
    @parent
    
    @include('layouts.header')
@endsection

@section('menu')
    @parent
    
    @include('layouts.menu')
@endsection

@section('content')
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>View</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($users))
                <tr>
                    <td colspan='5'>No users found</td>
                </tr>
            @else
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->user_role}}</td>
                        <td><a href='{{ url("users/$user->id") }}'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                        <td><a href='{{ url("edit_user/$user->id") }}'><span class='glyphicon glyphicon-pencil'></span></a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection