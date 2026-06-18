<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctf extends Model
{
    protected $fillable = ['name', 'slug', 'year'];

    public function writeups()
    {
        return $this->hasMany(Writeup::class);
    }
}
