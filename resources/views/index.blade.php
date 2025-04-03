@extends('layouts.default')

@section('pageTitle','Home - SoftContacts')

@section('content')
    <x-nav />


    <div class="container p-2">

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

        <div class="d-flex justify-content-between">
            <form action="{{ route('index.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name" class="form-control">
                    <input type="email" name="email" placeholder="email" class="form-control">
                    <input type="text" name="contact" placeholder="contact" class="form-control">
                    <button class="btn btn-outline-success"><i class="bi bi-search"></i></button>
                    <a href="{{ route('index.index') }}" class="btn btn-outline-info"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </form>

            <div>
                <a href="{{ route('contact.creation') }}" class="btn btn-outline-primary"><i class="bi bi-plus-lg"></i></a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->contact }}</td>
                            <td>
                                 <a href="{{ route('contact.edit', ['id'=>$contact->id]) }}" class="btn btn-sm btn-warning">
                                     <i class="bi bi-pencil"></i> Editar
                                </a>

                                <form action="{{ route('contact.delete', ['id' => $contact->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-white">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="alert alert-info mb-0">
                                    No contact found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($contacts->hasPages())
                <div class="d-flex justify-content-start">
                    {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>

    </div>
@endsection
