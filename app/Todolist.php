<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    // Accessor - changes what is displayed when the model shows 'name'
    public function getNameAttribute($value) {
        $pattern = '/^\d+-{1}/';
        $replacement = '';
        return preg_replace($pattern, $replacement, $value);
    }

    // Mutator - changes what is saved to the database for 'name'
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = \Auth::id() . '-' . $value;
    }

}
