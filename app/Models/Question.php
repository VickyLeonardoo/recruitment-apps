<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function choice(){
        return $this->hasMany(Choice::class);
    }

    public function test_result(){
        return $this->hasMany(TestResult::class,'question_id','id');
    }
}
