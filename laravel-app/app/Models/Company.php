<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'website', 'logo', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
