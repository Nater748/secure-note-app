<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    protected $table = 'trash';
    public $timestamps = false;
    protected $fillable = ['title', 'body', 'importance', 'users_id', 'deleted_at' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
