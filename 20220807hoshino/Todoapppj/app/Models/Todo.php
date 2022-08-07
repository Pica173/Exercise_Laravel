<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['content','users_id','tags_id'];

    protected $guarded = array('id');

    public function tags(){//追記
		return $this->belongsTo('App\Models\Tag');
    }
    public function users(){//追記
		return $this->belongsTo('App\Models\User');
    }
}