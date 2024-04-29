<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function listApi() {
        $teachers = User::where("role", 2)->get();

        return $teachers;
    }
}
