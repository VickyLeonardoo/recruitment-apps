<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleLine extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function application(){
        return $this->belongsTo(Application::class,'application_id','id');
    }

}
