<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LearnerCourse extends Model
{
    /**
     * The attributes that is table name.
     *
     * @var array
     */
    protected $table = 'learner_course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'learner_id', 'course_id',
    ];

    /**
     * Relationship with User
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'learner_id', 'id');
    }

    /**
     * Relationship with Course
     * @return object
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }


     /**
     * A function to get a list of CourseId's that have only been completed by 1 Learner.
     *
     * @return objects array
     */
    public function getLearnerCourses()
    {
        /*$LearnerCourses = $this
            ->join('courses as course', 'course.id', '=', 'learner_course.course_id')
            ->selectRaw('learner_course.course_id, COUNT(learner_course.learner_id) as count FROM learner_course group by learner_course.course_id order by count limit 1')
            ->get();
        return $LearnerCourses;*/

        $LearnerCourses = DB::select('select courses.id,courses.name, courses.description, learner_course.course_id, COUNT(learner_course.learner_id) as count FROM learner_course INNER JOIN courses ON courses.id = learner_course.course_id group by learner_course.course_id order by count limit 2');
        return $LearnerCourses;
    }
}
