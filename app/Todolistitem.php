<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Todolistitem extends Model
{

    public function list() {
        return $this->belongsTo('App\Todolist');
    }

}
