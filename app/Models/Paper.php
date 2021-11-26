<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasDocumentAndImage;

class Paper extends Model
{
    use HasFactory, HasDocumentAndImage;
    
    protected $fillable = [
        'paper_id',
        'title',
        'subtitle'
    ];
}
