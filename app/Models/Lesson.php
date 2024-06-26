<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'lesson_name',
        'start_time',
        'end_time',
    ];

    // 1 class - 1 room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_lessons', 'lesson_id', 'document_id');
    }
}
