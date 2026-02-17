@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Upload Card -->
        <div class="card shadow-lg glass-card mt-5">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">📤 Upload Document</h4>
            </div>

            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="/upload" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Choose File</label>
                        <input type="file" name="file" class="form-control form-control-lg">
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 upload-btn">
                        Upload
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

<style>
/* Glass Card Effect */
.glass-card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.1);
    animation: fadeInUp 0.8s forwards;
}

/* Entrance Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Upload Button Hover */
.upload-btn {
    transition: all 0.3s ease;
}
.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

/* Input Focus Styling */
input[type="file"]:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 5px rgba(13,110,253,0.5);
}
</style>

@endsection
