<?php

use App\Http\Controllers\StateController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Students
Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/student', [StudentController::class, 'create'])->name('students.create');
Route::post('/student', [StudentController::class, 'store'])->name('students.store');
Route::get('/student/show/{studentId}', [StudentController::class, 'show'])->name('students.show');
Route::post('/student/update/{studentId}', [StudentController::class, 'update'])->name('students.update');
Route::get('/student/destroy/{studentId}', [StudentController::class, 'destroy'])->name('students.destroy');

//get states based on country selection
Route::get('/states/{countryId}', [StateController::class, 'getStates'])->name('getStates');

// get qualifications by student id
Route::get('/qualifications/{studentId}', [StudentController::class, 'getQualifications'])->name('getQualifications');
