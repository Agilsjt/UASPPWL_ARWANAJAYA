<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Skill;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'position',
        'profile_picture',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}