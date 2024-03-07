<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\LearnerCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    private $learnerCourse;

    /**
     * Create a new controller instance.
     *
     * @param $courseSession \App\Models\CourseSession
     * @param $sessionExercise \App\Models\SessoinExercise
     *
     * @return void
     */
    public function __construct(LearnerCourse $learnerCourse)
    {
        $this->learnerCourse = $learnerCourse;

    }

    // all courses
    public function index()
    {
          $user = Auth::user()->id; //This line of code will give Authenticated user id.
          $courses = LearnerCourse::with('user','course')->where('learner_course.learner_id', '=', $user)->get()->toArray();
          return array_reverse($courses);
    }

    // view specific course
    public function view($id)
    {
        $user = Auth::user()->id; //This line of code will give Authenticated user id.
        $course = LearnerCourse::with('user','course')->where('learner_course.learner_id', '=', $user)
                                          ->where('learner_course.course_id', '=', $id)->get()->toArray();
        return response()->json($course);
    }

    // add courses
    public function add(Request $request)
    {
        $course = new Course([
            'name' => $request->name,
            'description' => $request->description
        ]);
        $course->save();
        $lastInsertedCourseId = $course->id;

        $courselearner = new LearnerCourse([
            'learner_id' => Auth::user()->id,
            'course_id' => $lastInsertedCourseId,
        ]);
        $courselearner->save();

        return response()->json('The course successfully added');
    }

    // edit courses
    public function edit($id)
    {
        $course = LearnerCourse::find($id);
        return response()->json($course);
    }

    // update course
    public function update($id, Request $request)
    {
        $course = LearnerCourse::find($id);
        $coursesOb = Course::find($course->course_id);
        $coursesOb->update($request->all());

        return response()->json('The course successfully updated');
    }

    // delete course
    public function delete($id)
    {
        $course = LearnerCourse::find($id);
        $coursesOb = Course::find($course->course_id);
        $coursesOb->delete();

        return response()->json('The course successfully deleted');
    }

//Return a list of CourseId's that have only been completed by 1 Learner.
    public function learner()
    {
        try {
            $learnerCourses = $this->learnerCourse->getLearnerCourses();
            return array_reverse($learnerCourses);

        } catch (\Exception $e) {

            return $this->sendError('SYSTEM ERROR.', ['error'=> $e->getMessage() ]);
            return $this->sendError('SYSTEM ERROR.', ['error'=>'System is not responding. Please try again.']);

        }
    }

}
