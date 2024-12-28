<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFormRequest;
use App\Services\StudentService;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $viewData = [];
    /**
     * Creating index page - list of students 
     */
    public function index(
        StudentService $studentService
    ) {
        try {
            $students = $studentService
                ->getStudents()
                ->get();
        } catch (Exception $e) {
            abort(500);
        }

        $this->viewData['students'] = $students;
        return view('student.index', $this->viewData);
    }

    /**
     * show student add form
     */
    public function create(
        StudentService $studentService
    ) {
        try {
            $this->viewData['basicData'] = $studentService->basicData();
        } catch (Exception $e) {
            abort(500);
        }

        return view('student.add', $this->viewData);
    }

    /**
     * Create student
     */
    public function store(
        StudentFormRequest $studentFormRequest,
        StudentService $studentService
    ) {
        $validatedFields = $studentFormRequest->validated();

        try {
            $studentService->store(
                studentId: null,
                validatedFields: $validatedFields
            );
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Student added successfully'
        ];
    }

    /**
     * show student update form
     */
    public function show(
        int $studentId,
        StudentService $studentService
    ) {
        try {
            $this->viewData['basicData'] = $studentService->basicData();
            $this->viewData['studentDetails'] = $studentService->studentById(
                studentId: $studentId
            )
                ->first();
        } catch (Exception $e) {
            abort(500);
        }

        return view('student.edit', $this->viewData);
    }

    /**
     * Update student
     */
    public function update(
        int $studentId,
        StudentFormRequest $studentFormRequest,
        StudentService $studentService
    ) {
        $validatedFields = $studentFormRequest->validated();

        try {
            $studentService->store(
                studentId: $studentId,
                validatedFields: $validatedFields
            );
        } catch (Exception $e) {
            dd($e->getMessage());
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Student added successfully'
        ];
    }

    /**
     * Delete student
     */
    public function destroy(
        int $studentId,
        StudentService $studentService
    ) {
        try {
            $studentService->delete($studentId);
        } catch (Exception $e) {
            abort(500);
        }

        return redirect()->back();
    }

    /**
     * get qualifications
     */
    public function getQualifications(
        int $studentId,
        StudentService $studentService
    ) {
        try {
            $qualifications = $studentService->studentQualifications(
                studentId: $studentId
            )->get();
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Qualifications fetched successfully',
            'data' => $qualifications
        ];
    }
}
