<?php

namespace App\Traits;

use App\Models\PaperDocument as Document;
use App\Models\PaperImage as Image;

trait HasDocumentAndImage
{
    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
