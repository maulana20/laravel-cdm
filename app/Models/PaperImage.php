<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'paper_id',
        'image',
    ];
    
    public $timestamps = false;
    
    public function paper()
    {
        $this->belongsTo(Paper::class);
    }
}
