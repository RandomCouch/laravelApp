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
    <form method='POST' action="{{ url('/create_blog_post') }}">
    <h4>Create post</h4>
    @if (!empty(session('errors')))
        @foreach(session('errors') as $error)
            <div class='alert alert-danger'>{{$error}}</div>
        @endforeach
    @endif
    <table class='table table-striped'>
        <tbody>
            <tr>
                <td>Author</td>
                <td>
                    <select name="author" class="form-control">
                        @foreach($users as $user)
                            <option value='{{$user->id}}'>{{$user->username}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Title</td>
                <td><input type='text' class='form-control' placeholder='Title' name='title'></td>
            </tr>
            <tr>
                <td>Content</td>
                <td>
                    <textarea name="content" class="form-control" placeholder="Content"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan='2'><button class='btn btn-primary' type='submit'>Create</button></td>
            </tr>
        </tbody>
    </table>
    
    </form>
@endsection