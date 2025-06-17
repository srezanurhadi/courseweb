<?php
// app/Models/UploadedImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo; // <-- Import

class UploadedImage extends Model
{
    // ... properti $fillable tetap sama ...
    protected $fillable = [
        'filename',
        'path',
        'url',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Dapatkan model parent yang memiliki gambar ini (Content, UserProfile, dll.).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
