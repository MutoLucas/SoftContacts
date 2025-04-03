@extends('layouts.default')

@section('pageTitle','Login - SoftContacts')

@section('content')
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container col-10 col-md-4 border border-light shadow-lg bg bg-light rounded-4 p-3">
        <h1 class="text-center fs-3 mb-0">Welcome to SoftContacts</h1>
        <div class="d-flex justify-content-center">
            <small class="mt-0">Your best contacts book</small>
        </div>

        @if(Session()->has('errorLogin'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="height: 60px">
            <p>{{ Session('errorLogin') }}</p>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('auth.auth') }}" method="POST">
            @csrf
            <div class="input-group p-3">
                <span class="input-group-text border-secondary"><i class="bi bi-person"></i></span>
                <input type="email" class="form-control border-secondary" name="email">
            </div>

            <div class="">
                <div class="input-group p-3 mb-0">
                    <span class="input-group-text border-secondary"><i class="bi bi-key"></i></span>
                    <input type="password" id="password" class="form-control border-secondary" name="password">
                    <button type="button" id="switchBtn" class="btn btn-outline-secondary rounded-end"><i id="iconEye" class="bi bi-eye"></i></button>

                    <script>
                        const switchBtn = document.getElementById('switchBtn');
                        const password = document.getElementById('password');
                        const icon = document.getElementById('iconEye');

                        switchBtn.addEventListener('click', ()=>{
                            if(password.type == 'password'){
                                icon.classList.remove('bi-eye');
                                icon.classList.add('bi-eye-slash');
                                password.type = 'text';
                            }else{
                                icon.classList.add('bi-eye');
                                icon.classList.remove('bi-eye-slash');
                                password.type = 'password';
                            }
                        });
                    </script>
                </div>
            </div>

            <div class="d-flex justify-content-center p-2">
                <button type="submit" class="btn btn-primary w-50">login</button>
            </div>
        </form>
    </div>
</div>
@endsection
