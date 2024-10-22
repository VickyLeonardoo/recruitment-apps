<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function position(){
        return $this->hasMany(Position::class);
    }
}
