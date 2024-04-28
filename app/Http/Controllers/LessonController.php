<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function getLessonDetail(Request $request)
    {
        $lesson = Lesson::where('id', $request->lesson_id)->with(['classroom', 'room'])->first();

        return response()->json(
            [
                'data' => $lesson,
            ],
            200
        );
    }
}
