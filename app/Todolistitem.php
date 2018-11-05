<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Todolistitem extends Model
{

    public function list() {
        return $this->belongsTo('App\Todolist', 'todolist_id', 'id');
    }

    // The nice date we show to users
    public function prettyUpdate() {

        $dt = new Carbon($this->updated_at);
        if ($dt->isToday()) {
            return $dt->format('g:i:s a');
        }
        return $dt->format('n/j/y \\a\\t g:i:s a');

    }

}
