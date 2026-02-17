<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentView;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();

        foreach ($documents as $doc) {
            $doc->signed_url = \URL::temporarySignedRoute(
                'preview',
                now()->addMinutes(5),
                ['document' => $doc->id]
            );
        }

        return view('documents', compact('documents'));
    }

    public function preview(Document $document)
    {
        // Role protection
        if (auth()->user()->role !== 'viewer') {
            abort(403);
        }

        $path = storage_path('app/' . $document->original_path);


        if (!file_exists($path)) {
            abort(404);
        }
        $mime = $document->mime_type;
        DocumentView::create([
            'document_id' => $document->id,
            'user_id'     => auth()->id(),
            'ip'          => request()->ip(),
        ]);

        return response()->file($path, [
             'Content-Type' => $mime,
             'Content-Disposition' => 'inline',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN'
        ]);
    }
}
