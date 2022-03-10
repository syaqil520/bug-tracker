<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'author_id'];

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('roles')->select(['id', 'email', 'name']);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
