<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function job(){
        return $this->belongsTo(JobVacancy::class,'job_vacancy_id');
    }

    public function test(){
        return $this->hasOne(Test::class);
    }

    public function schedule(){
        return $this->hasOne(ScheduleLine::class);
    }
}
