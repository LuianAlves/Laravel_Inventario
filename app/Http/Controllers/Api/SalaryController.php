<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function Paid(Request $request, $id) {
        $ValidateData = $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id', $id)->where('salary_month', $month)->first(); // Verifica se ja foi pago

            if($check) {
                return response()->json('Salary Already Paid');

            } else {
                
                $data = array();
                $data['employee_id'] = $id;
                $data['amount'] = $request->sallery;
                $data['salary_date'] = date('d/m/Y');
                $data['salary_month'] = $month; // date('F');
                $data['salary_year'] = date('Y');
                
                $salary = Salary::insert($data);
            }
    }

    public function allSalary() {
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }

    public function viewSalary($id) {
        $month = $id;

        $view = Salary::join('employees', 'salaries.employee_id', 'employees.id')
                      ->select('employees.name', 'salaries.*')
                      ->where('salaries.salary_month', $month)
                      ->get();

        return response()->json($view);
    }

    public function editSalary($id) {

        $view = Salary::join('employees', 'salaries.employee_id', 'employees.id')
                      ->select('employees.name', 'employees.email', 'salaries.*')
                      ->where('salaries.id', $id)
                      ->first();

        return response()->json($view);
    }

    public function updateSalary(Request $request, $id) {
        $data = array();

        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;
        
        $salary = Salary::where('id', $id)->update($data);
    }
}
