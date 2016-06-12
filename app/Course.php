<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'name', 'description'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function periods()
    {
        return $this->hasMany('App\Period');
    }
    

    /**
    *   Checks if there is a conflict between periods
    *
    */
    public static function checkSchedule($periods)
    {
        $schedule = [
            [],
            [],
            [],
            [],
            [],
            [],
            []
        ];

        foreach ($periods as $period) {
            $day = intval($period['day']);
            $start = intval($period['start']);
            $end = intval($period['end']);

            // check day
            if ($day <= 0 || $day > 6) {
//                echo 'invalid day';
                return false;
            }

            // check values
            if ($start < 0 || $start > 24) {
//                echo 'invalid day';
                return false;

            }// check values
            if ($end < 0 || $end > 24) {
//                echo 'invalid day';
                return false;
            }
            if ($start > $end || $end <$start) {
//                echo 'invalid day';
                return false;
            }

//            echo "evaliating: $start - $end  \n";

            if (empty($schedule[$day])) {
                $schedule[$day][] = [$start, $end];
//                echo "add [$start, $end] \n";
            } else {

                foreach ($schedule[$day] as $commitment) {


//                    echo "current: $commitment[0] - $commitment[1]  \n";

                    // check if the new period conflicts with existing ones
                    if (
                        ($start >= $commitment[0] && $start < $commitment[1]) ||
                        ($end > $commitment[0] && $end < $commitment[1])
                    ) {

//                        echo 'INVALID!!!!!!!';
                        return false;
                    }
                    $schedule[$day][] = [$start, $end];
                }
            }


        }

        return true;
    }
}
