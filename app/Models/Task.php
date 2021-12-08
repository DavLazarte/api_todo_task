<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','img_url','id_user','state'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
