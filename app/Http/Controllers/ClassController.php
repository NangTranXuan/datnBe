<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function getLessonToday(Request $request) {
        $type = $request->type; // type = 1 is today, = null is allday

        if($type == 1) {
            $user = User::where('id', $request->user()->id)->with([
                'classrooms' => [
                    'room',
                    'lessons' => function (Builder $query) {
                        $query->whereDate('start_time', Carbon::today());
                    },
                    'teacher'
                ],
            ])->get();
        } else {
            $user = User::where('id', $request->user()->id)->with([
                'classrooms' => [
                    'room',
                    'lessons',
                    'teacher'
                ],
            ])->get();
        }
        $classrooms = $user[0]["classrooms"];

        return $classrooms;
    }

    public function getTask(Request $request) {
        $user = User::where('id', $request->user()->id)->with([
            'classrooms' => [
                'room',
                'exams' => function (Builder $query) {
                    $query->whereBetween('start_time', [Carbon::today(), Carbon::today()->addDays(3)]);
                },
                'homeworks' => function (Builder $query) {
                    $query->whereBetween('start_time', [Carbon::today(), Carbon::today()->addDays(3)]);
                },
                'teacher'
            ],
        ])->get();

        $classrooms = $user[0]["classrooms"];

        return $classrooms;
    }

}
