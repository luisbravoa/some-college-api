<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{

    protected $fillable = [
        'day', 'required',
        'start', 'required',
        'end', 'required',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function toArray () {
        return [
            'day' => $this->day,
            'start' => $this->start,
            'end' => $this->end
        ];
    }
}
