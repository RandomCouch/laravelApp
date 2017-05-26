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
    <form method='POST' action="{{ url('/edit_user/' . $user->id) }}">
    <h4>Edit User: {{$user->username}}</h4>
    @if (!empty(session('errors')))
        @foreach(session('errors') as $error)
            <div class='alert alert-danger'>{{$error}}</div>
        @endforeach
    @endif
    <table class='table table-striped'>
        <tbody>
            <tr>
                <td>Username</td>
                <td><input type='text' class='form-control' placeholder='Username' name='username' value="{{$user->username}}"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type='text' class='form-control' placeholder='Email' name='email' value="{{$user->email}}"></td>
            </tr>
            <tr>
                <td>Role</td>
                <td>
                    <select name="user_roles_id" class="form-control">
                        <option value='1' {{{ ($user->user_role == "Admin" ? 'selected' : '') }}}>Admin</option>
                        <option value='2' {{{ ($user->user_role == "Publisher" ? 'selected' : '') }}}>Publisher</option>
                        <option value='3' {{{ ($user->user_role == "Public User" ? 'selected' : '') }}}>Public User</option>
                    </select>
                </td>
            </tr><tr>
                <td>Address</td>
                <td><input type='text' class='form-control' placeholder='Address' name='address' value="{{$user->address}}"></td>
            </tr><tr>
                <td>Province</td>
                <td><input type='text' class='form-control' placeholder='Province' name='province' value="{{$user->province}}"></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type='text' class='form-control' placeholder='City' name='city' value="{{$user->city}}"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type='text' class='form-control' placeholder='Country' name='country' value="{{$user->country}}"></td>
            </tr>
            <tr>
                <td>Postal Code</td>
                <td><input type='text' class='form-control' placeholder='Postal Code' name='postal_code' value="{{$user->postal_code}}"></td>
            </tr>
            <tr>
                <td colspan='2'><button class='btn btn-primary' type='submit'>Update</button></td>
            </tr>
        </tbody>
    </table>
    
    </form>
@endsection