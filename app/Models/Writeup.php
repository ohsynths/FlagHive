<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writeup extends Model
{
    protected $fillable = ['user_id', 'category_id', 'ctf_id', 'title', 'slug', 'description', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ctf()
    {
        return $this->belongsTo(Ctf::class);
    }
}
