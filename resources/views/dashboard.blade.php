@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-lg border-0">
            <div class="card-body text-center p-5">

                <h3 class="mb-3">Welcome, {{ auth()->user()->name }}</h3>

                <span class="badge 
                    {{ auth()->user()->role === 'uploader' ? 'bg-success' : 'bg-primary' }}">
                    {{ ucfirst(auth()->user()->role) }}
                </span>

                <hr class="my-4">

                @if(auth()->user()->role === 'uploader')
                    <a href="/upload" class="btn btn-success btn-lg w-100">
                        📤 Go to Upload Section
                    </a>
                @endif

                @if(auth()->user()->role === 'viewer')
                    <a href="/documents" class="btn btn-primary btn-lg w-100">
                        📄 View Documents
                    </a>
                @endif

            </div>
        </div>

    </div>
</div>

@endsection
