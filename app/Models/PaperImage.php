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
    
    protected $appends = [
        'image_full'
    ];
    
    public function paper()
    {
        $this->belongsTo(Paper::class);
    }
    
    public function getImageFullAttribute()
    {
        return url('storage/' . $this->image);
    }
}
