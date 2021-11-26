<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperDocument extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'paper_id',
        'attachment',
        'quarter',
        'final',
    ];
    
    public $timestamps = false;
    
    public function paper()
    {
        $this->belongsTo(Paper::class);
    }
}
