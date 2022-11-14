<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Regulation;
use App\Models\Semester;
use App\Models\SemesterResult;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('app');
    }



    public function semesters()
    {
        return Semester::all();
    }

    public function subjects($semester)
    {
        return Subject::where('semester_id', $semester)->get();
    }

    public function regulation(Request $request)
    {
        $regu = Regulation::select('*')->where('semester_id', $request->semester_id)->first();
        if (!empty($regu->id)) {
            if ($request->semester_value != $regu->semester_velue) {
                $regu->semester_value = $request->semester_value;
                $regu->save();
            }
        } else {
            $newRegu = new Regulation();
            $newRegu->semester_id = $request->semester_id;
            $newRegu->semester_value = $request->semester_value;
            $newRegu->status = 1;
            $newRegu->save();
        }

        $regu = Regulation::select('regulations.id', 'semesters.name as semester_name', 'regulations.semester_value')
            ->join('semesters', 'semesters.id', 'regulations.semester_id')->get();
        return response()->json($regu);
    }

    public function AllRegulation()
    {
        $regu = Regulation::select('regulations.id', 'semesters.name as semester_name', 'regulations.semester_value')
            ->join('semesters', 'semesters.id', 'regulations.semester_id')->get();
        return response()->json($regu);
    }

    public function generator()
    {
        $departmentId = 7;
        $students = Student::all();
        for ($i = 1; $i <= count($students); $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $subjects = Subject::select('code as subcode', 'total', 'semester_id', 'cradit')->where('semester_id', $j)->get();
                for ($k = 0; $k < count($subjects); $k++) {

                    $studentId = $i;
                    $departmentId;
                    $semester = $j;
                    $subjectCode = $subjects[$k]->subcode;
                    $subTotal = $subjects[$k]->total;
                    $cradit = $subjects[$k]->cradit;
                    if ($subTotal == 200) {
                        $mark = rand(0, 200);
                    } else if ($subTotal == 150) {
                        $mark = rand(0, 150);
                    } else if ($subTotal == 50) {
                        $mark = rand(0, 50);
                    } else {
                        $mark = rand(0, 100);
                    }

                    $unit =  $subTotal / 100;
                    $percentage = $unit * $mark;

                    if ($percentage >= 80) {
                        $grade = 4;
                    } else if ($percentage >= 75) {
                        $grade = 3.75;
                    } else if ($percentage >= 70) {
                        $grade = 3.5;
                    } else if ($percentage >= 65) {
                        $grade = 3.25;
                    } else if ($percentage >= 60) {
                        $grade = 3;
                    } else if ($percentage >= 55) {
                        $grade = 2.75;
                    } else if ($percentage >= 50) {
                        $grade = 2.5;
                    } else if ($percentage >= 45) {
                        $grade = 2.25;
                    } else if ($percentage >= 40) {
                        $grade = 2;
                    } else {
                        $grade = 0;
                    }
                    $credidXgrade = $grade * $subjects[$k]->cradit;
                    if ($j == $subjects[$k]->semester_id) {
                        $singleExam =  array(
                            'student_id' => $studentId,
                            'depertment' => $departmentId,
                            'semester' => $semester,
                            'subject' => $subjectCode,
                            'mark' => $mark,
                            'subTotal' => $subTotal,
                            'percentage' => $percentage,
                            'grade' => $grade,
                            'cradit' => $cradit,
                            'credidXgrade' => $credidXgrade,
                            'status' => 1,
                        );
                        $data[$j][$k] = $singleExam;

                        $exam = new Exam();
                        $exam->student_id = $studentId;
                        $exam->depertment = $departmentId;
                        $exam->semester = $semester;
                        $exam->subject = $subjectCode;
                        $exam->mark = $mark;
                        $exam->status = 1;
                        $exam->save();
                    }
                    foreach ($data[$j][$k] as $key => $value) {
                        if ($key == 'cradit') {
                            $totalCreadit[] = $value;
                        }
                        if ($key == 'credidXgrade') {
                            $totalcredidXgrade[] = $value;
                        }
                    }
                }

                $gpa = array_sum($totalcredidXgrade) / array_sum($totalCreadit);

                $semResult = new SemesterResult();
                $semResult->exam_id = $exam->id;
                $semResult->student_id = $studentId;
                $semResult->gpa = $gpa;
                $semResult->status = 1;
                $semResult->save();
            }
        }
        return response()->json(sizeof($data));
    }

    public function cgpa(Request $request)
    {
        $roll = $request->roll;
        $semesters = Student::select('students.name', 'students.roll', 'semester_results.exam_id', 'semester_results.gpa', 'semesters.name as semesterName', 'regulations.semester_value')
            ->where('roll', $roll)
            ->join('semester_results', 'students.id', 'semester_results.student_id')
            ->join('exams', 'exams.id', 'semester_results.exam_id')
            ->join('semesters', 'semesters.id', 'exams.semester')
            ->join('regulations', 'regulations.semester_id', 'semesters.id')
            ->get();

        if (!$semesters->isEmpty()) {
            foreach ($semesters as $key => $value) {
                $gpa = $value->gpa;
                $semValue = $value->semester_value;
                $percentGpa = $gpa * ($semValue / 100);
                $cgpa[] = $percentGpa;
            }

            return response()->json([
                'semester' => $semesters,
                'cgpa' => array_sum($cgpa)
            ]);
        } else {
            return response()->json([
                'error' => '404'
            ]);
        }
    }
}
