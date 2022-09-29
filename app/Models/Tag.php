<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    } 
}
