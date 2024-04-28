<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClassController extends Controller
{
    public function getListClass(Request $request)
    {
        $type = $request->type; // type = 1 is today, = null is allday
        $classroomIds = User::find($request->user()->id)->classrooms->pluck('id')->toArray();
        $classrooms = Classroom::whereIn('id', $classroomIds)->with(['room', 'lessons' => ['documents'], 'teacher'])->get();

        $numberOfLessonsStudied = 0;
        foreach ($classrooms as $classroom) {
            $classroom['countLessons'] = count($classroom->lessons);
            foreach ($classroom->lessons as $lesson) {
                $numberOfLessonsStudied += $lesson['is_finished'];
                $attendenceStatus = Attendance::where('lesson_id', $lesson->id)->where('student_id', $request->user()->id)->first()?->status;
                $lesson['attendenceStatus'] = $attendenceStatus;
            }
            $classroom['numberOfLessonsStudied'] = $numberOfLessonsStudied;
        }

        return response()->json(
            [
                'data' => $classrooms,
            ],
            200
        );
    }

    public function classDetail(Request $request)
    {
        $classrooms = Classroom::whereIn('id', $request->class_id)->with(['room', 'lessons' => ['documents'], 'teacher'])->get();

        $numberOfLessonsStudied = 0;
        foreach ($classrooms as $classroom) {
            $classroom['countLessons'] = count($classroom->lessons);
            foreach ($classroom->lessons as $lesson) {
                $numberOfLessonsStudied += $lesson['is_finished'];
                $attendenceStatus = Attendance::where('lesson_id', $lesson->id)->where('student_id', $request->user()->id)->first()?->status;
                $lesson['attendenceStatus'] = $attendenceStatus;
            }
            $classroom['numberOfLessonsStudied'] = $numberOfLessonsStudied;
        }

        return response()->json(
            [
                'data' => $classrooms,
            ],
            200
        );
    }

    public function getLessonToday(Request $request)
    {
        $classroomIds = User::find($request->user()->id)->classrooms->pluck('id')->toArray();
        $classrooms = Classroom::whereIn('id', $classroomIds)->with(['room',
            'lessons' => function (Builder $query) {
                $query->whereDate('start_time', Carbon::today());
            },
            'teacher'])->get();

        $numberOfLessonsStudied = 0;
        foreach ($classrooms as $key => $classroom) {
            foreach ($classroom->lessons as $lesson) {
                $numberOfLessonsStudied += $lesson['is_finished'];
            }
            $classroom['numberOfLessonsStudied'] = $numberOfLessonsStudied;
        }

        return response()->json(
            [
                'data' => $classrooms,
            ],
            200
        );
    }

    public function getTask(Request $request)
    {
        $user = User::where('id', $request->user()->id)->with([
            'classrooms' => [
                'room',
                'exams' => function (Builder $query) {
                    $query->whereBetween('end_time', [Carbon::today(), Carbon::today()->addDays(3)]);
                },
                'homeworks' => function (Builder $query) {
                    $query->whereBetween('end_time', [Carbon::today(), Carbon::today()->addDays(3)]);
                },
                'teacher',
            ],
        ])->get();

        $classrooms = $user[0]['classrooms'];

        return response()->json(
            [
                'data' => $classrooms,
            ],
            200
        );
    }

    public function getLessonScheduleTask(Request $request)
    {
        $time = strtotime($request->datetime);
        $today = date('Y-m-d', $time);

        $user = User::where('id', $request->user()->id)->with([
            'classrooms' => [
                'room',
                'lessons' => function (Builder $query) use ($today) {
                    $query->whereDate('start_time', $today);
                },
                'teacher',
            ],
        ])->get();

        $classrooms = $user[0]['classrooms'];

        return response()->json(
            [
                'data' => $classrooms,
            ],
            200
        );
    }
}
