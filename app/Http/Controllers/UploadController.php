<?php

namespace App\Http\Controllers;
use NcJoes\OfficeConverter\OfficeConverter;
use Illuminate\Support\Str;
use App\Models\Document;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

 public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:pdf,txt|max:10240'
    ]);

    if (auth()->user()->role !== 'uploader') {
        abort(403);
    }

    $file = $request->file('file');

    $path = $file->store('private/originals');

    Document::create([
        'original_name' => $file->getClientOriginalName(),
          'original_path' => $path,
    
        'mime_type' => $file->getClientMimeType(),
        'size' => $file->getSize(),
        'uploaded_by' => auth()->id(),
    ]);

    return back()->with('success', 'Uploaded Successfully');
}

}
