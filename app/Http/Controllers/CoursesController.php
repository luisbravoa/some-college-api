<?php

namespace App\Http\Controllers;

use App\Period;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Course;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{

    public $rules = [
        'name' => 'required',
        'description' => 'required'
    ];


    public function index()
    {

        return Course::all()->load('periods');
    }

    public function indexByUser(User $user)
    {

        return $user->courses->load('periods');
    }

    public function show(Course $course)
    {
        $course->load('periods');
        return $course;
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules);

        if (!Course::checkSchedule($request->get('periods'))) {
            return $this->respondWithError(
                array_merge(
                    $validator->errors()->toArray(),
                    ['periods' => 'There is a conflict in the schedule or the period is malformed.']
                )
            );
        }

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors());
        }


        $course = new Course($request->all());
        $course->save();

        foreach ($request->get('periods') as $item) {
            $period = new Period($item);
            $course->periods()->save($period);
        }

        $course->load('periods');

        return $course;
    }


    public function update(Course $course, Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors());
        }


        $course->update($request->all());

        return $course;
    }

    public function destroy(Course $course)
    {
        return Course::destroy($course->id);
    }
}
