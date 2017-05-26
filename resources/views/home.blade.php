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
    <p>Welcome to my demo</p>
@endsection