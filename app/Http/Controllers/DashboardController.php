<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DashboardController extends Controller
{
    public function index()
    {
        $documents = Document::with('user','views')->latest()->get();
        $totalDocuments = $documents->count();
        $totalViews = $documents->sum(function($doc){ return $doc->views->count(); });

        return view('dashboard', compact('documents', 'totalDocuments', 'totalViews'));
    }
}

