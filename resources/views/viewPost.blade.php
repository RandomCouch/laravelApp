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
    <h4>View Post: {{$post->title}}</h4>
    @if (!empty(session('success')))
        @foreach(session('success') as $success)
            <div class='alert alert-success'>{{$success}}</div>
        @endforeach
    @endif
    <table class='table table-striped'>
        <tbody>
            <tr>
                <td>Title</td>
                <td>{{$post->title}}</td>
            </tr>
            <tr>
                <td>Content</td>
                <td>{{$post->content}}</td>
            </tr>
            <tr>
                <td>Author</td>
                <td><a href='{{url("/users/$post->author")}}'>{{$post->username}}</a></td>
            </tr><tr>
                <td>Date Created</td>
                <td>{{$post->created_at}}</td>
            </tr><tr>
                <td>Date Updated</td>
                <td>{{$post->updated_at}}</td>
            </tr>
        </tbody>
    </table>
@endsection