<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'advertisement_id'
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
