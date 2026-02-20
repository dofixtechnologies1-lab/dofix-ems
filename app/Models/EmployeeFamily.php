<?php

namespace App\Models;
 use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeFamily extends Model
{
public function profile($id)
{
    $employee = Employee::with('families')->findOrFail($id);
    return view('employees.profile', compact('employee'));
}
protected $fillable = [
    'employee_id',
    'name',
    'relationship',
    'dob',
    'phone'
];


}
