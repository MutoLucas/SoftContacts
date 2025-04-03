@extends('layouts.default')

@section('pageTitle','Edit Contact')

@section('content')
<x-nav />

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Editar Contato
                </div>

                @if(Session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="height: 60px">
                    <p>{{ Session('error') }}</p>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(Session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="height: 60px">
                    <p>{{ Session('success') }}</p>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('contact.edit.save', ['id'=>$contact->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" value="{{ $contact->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="contact" value="{{ $contact->contact }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" value="{{ $contact->email }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('index.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
