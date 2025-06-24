<?php
// app/Models/UploadedImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo; // <-- Import

class UploadedImage extends Model
{
    // ... properti $fillable tetap sama ...
    protected $fillable = [
        'filename',
        'path',
        'url',
        'uploaded_by',
        'imageable_id',
        'imageable_type',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
