@extends('layouts.default')

@section('pageTitle','Home - SoftContacts')

@section('content')
    <h1>Welcome {{ auth()->user()->name }} || <a href="{{ route('auth.logout') }}">Logout</a></h1>
@endsection
