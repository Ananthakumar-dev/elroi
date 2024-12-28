<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentQualification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StudentService
{
    /**
     * get all basic data to add/update form
     */
    public function basicData()
    {
        $countries = $this->countries()->get();

        $qualifications = $this->qualifications()->get();


        return [
            'countries' => $countries,
            'qualifications' => $qualifications,
        ];
    }

    /**
     * get all countries
     */
    public function countries()
    {
        $query = DB::table('countries');

        return $query;
    }

    /**
     * get all qualifications
     */
    public function qualifications()
    {
        $query = DB::table('qualifications');

        return $query;
    }

    /**
     * store student data
     */
    public function store(
        $studentId,
        array $validatedFields
    ) {
        $studentFields = ['name', 'country_id', 'state_id'];

        $studentValues = Arr::only(
            $validatedFields,
            $studentFields
        );

        $qualificationValues = Arr::except(
            $validatedFields,
            $studentFields
        );

        if ($studentId) {
            $student = Student::where(['id' => $studentId]);
            $student->update($studentValues);

            $student_id = $student->first()->id;
        } else {
            $student = Student::create($studentValues);
            $student_id = $student->id;
        }

        DB::table('student_qualifications')->where('student_id', $studentId)->whereNotIn('qualification_id', $qualificationValues['qualification'])->delete(); // delete unneccessary or previously added qualification

        foreach ($qualificationValues['qualification'] as $key => $qual) {
            StudentQualification::updateOrCreate(
                ['student_id' => $student_id, 'qualification_id' => $qual],
                [
                    'student_id' => $student_id,
                    'qualification_id' => $qual,
                    'year_of_passing' => $qualificationValues['year_of_passing'][$key],
                    'university' =>  $qualificationValues['university'][$key]
                ]
            );
        }
    }

    /**
     * get all students
     */
    public function getStudents()
    {
        // using raw queries for faster fetch
        $query = DB::table('students')
            ->join('countries', function ($join) {
                $join->on('countries.id', '=', 'students.country_id');
            })
            ->join('states', function ($join) {
                $join->on('states.id', '=', 'students.state_id');
            })
            ->select([
                'students.id',
                'students.name',
                'states.name AS state_name',
                'countries.name AS country_name'
            ]);

        return $query;
    }

    /**
     * get particular student data
     */
    public function studentById(
        $studentId
    ) {
        $query = DB::table('students')
            ->where(['id' => $studentId]);

        return $query;
    }

    /**
     * delete student
     */
    public function delete(
        $studentId
    ) {
        StudentQualification::where('student_id', $studentId)->delete();

        Student::where('id', $studentId)->delete();
    }

    /**
     * get qualifications
     */
    public function studentQualifications(
        $studentId
    ) {
        $query = DB::table('student_qualifications')
            ->where(['student_id' => $studentId])
            ->select([
                'id',
                'qualification_id',
                'year_of_passing',
                'university'
            ]);

        return $query;
    }
}
