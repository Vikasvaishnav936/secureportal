<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
    'original_name',
    'original_path',
    'preview_path',
    'mime_type',
    'size',
    'uploaded_by',
];

public function user()
{
    return $this->belongsTo(User::class, 'uploaded_by');
}

public function views()
{
    return $this->hasMany(DocumentView::class);
}


}
