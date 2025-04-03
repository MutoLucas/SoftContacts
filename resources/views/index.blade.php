@extends('layouts.default')

@section('pageTitle','Home - SoftContacts')

@section('content')
    <h1>Welcome {{ auth()->user()->name }}</h1>
@endsection
