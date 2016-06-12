<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required'
    ];

    public function login(Request $request)
    {
        $user = User::where(['email' => $request->get('email'), 'password' => $request->get('password')])->first();

        $user->load('courses.periods');

        return $user;
    }

    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {

        $user->load('courses.periods');
        return $user;
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors());
        }

        $user = new User($request->all());

        $user->api_token = str_random(60);

        $user->save();

        return $user;
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors());
        }

        $user->update(request()->all());
        return $user;
    }

    public function destroy(User $user)
    {
        return User::destroy($user->id);
    }

    public function enroll(User $user, Course $course)
    {

        $periods = [];
        foreach ($course->periods as $period) {
            $periods[] = $period->toArray();
        }

        foreach ($user->courses as $c) {
            foreach ($c->periods as $period) {
                $periods[] = $period->toArray();
            }
        }
        
        if (!Course::checkSchedule($periods)) {
            return $this->respondWithError(['periods' => 'There is a conflict with the times!']);
        }

        $user->courses()->attach($course->id);
        $user->save();

        $user->load('courses.periods');
        return $user;
    }

    public function dropout(User $user, Course $course)
    {

        $user->courses()->detach($course->id);

        $user->load('courses.periods');
        return $user;
    }
}
