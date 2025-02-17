<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'director',
        'release_date',
        'synopsis',
        'poster_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
