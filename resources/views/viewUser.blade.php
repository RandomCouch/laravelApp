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
    <h4>View User: {{$user->username}}</h4>
    <div class='sideButton'>
        <a href='{{ url("/edit_user/" . $user->id) }}'><span class='glyphicon glyphicon-pencil'></span></a>
    </div>
    @if (!empty(session('success')))
        @foreach(session('success') as $success)
            <div class='alert alert-success'>{{$success}}</div>
        @endforeach
    @endif
    <a href='{{ url("/blog_posts/u/" . $user->id) }}'>View all blog posts by this user</a>
    <table class='table table-striped'>
        <tbody>
            <tr>
                <td>Username</td>
                <td>{{$user->username}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td>Role</td>
                <td>{{$user->user_role}}</td>
            </tr><tr>
                <td>Address</td>
                <td>{{$user->address}}</td>
            </tr><tr>
                <td>Province</td>
                <td>{{$user->province}}</td>
            </tr>
            <tr>
                <td>City</td>
                <td>{{$user->city}}</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>{{$user->country}}</td>
            </tr>
            <tr>
                <td>Postal Code</td>
                <td>{{$user->postal_code}}</td>
            </tr>
        </tbody>
    </table>
@endsection