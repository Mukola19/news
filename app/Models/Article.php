<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'img'];
    
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }    

    public function delete()
    {
        $this->tags()->delete();
        return parent::delete();
    }
}
 