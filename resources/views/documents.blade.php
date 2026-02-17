

@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-dark text-white">
        Available Documents
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Uploaded By</th>
                    <th>Views</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->original_name }}</td>
                        <td>{{ number_format($document->size / 1024, 2) }} KB</td>
                        <td>{{ $document->user->name ?? 'N/A' }}</td>
                        <td>{{ $document->views->count() }}</td>
                        <td>
                            <a target="_blank" href="{{ $document->signed_url }}" 
                               class="btn btn-sm btn-primary">
                                Preview
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

