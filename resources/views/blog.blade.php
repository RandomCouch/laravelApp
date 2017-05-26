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
    <h4>All blog posts {{ $extraTitle }} </h4>
    <a href='{{ url("/create_blog_post") }}'><button class='btn btn-primary'>Create Blog Post</button></a>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Date Created</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($posts))
                <tr>
                    <td colspan='5'>No posts found</td>
                </tr>
            @else
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->username}}</td>
                        <td>{{$post->created_at}}</td>
                        <td><a href='{{ url("blog_posts/p/$post->id") }}'><span class='glyphicon glyphicon-eye-open'></span></a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection