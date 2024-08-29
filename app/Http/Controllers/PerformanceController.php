<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $performances = DB::table('employee_performance as ep')
                        ->join('employees as e','e.id','=','ep.employee_id')
                        ->selectRaw("ep.*, CONCAT(e.first_name,' ',e.last_name) as full_name, e.job_title")
                        ->orderby('created_at','desc')
                        ->get();
     

        return response()->json($performances);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( Request $request )
    {
       // $store_performance = $Performance::create($PerformanceRequest->all());
       // return response()->json(['message' => 'Employee Performance successfully saved', 'data' => $store_performance], 201);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'performance_dates' => 'required',
            'performance_scores' => 'required',
        ]);

         // Check if validation fails
         if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

         // Create a new Employee Performance instance and save the data
         $performance = new Performance([
            'employee_id' => $request->employee_id,
            'performance_dates' => $request->performance_dates,
            'performance_scores' => $request->performance_scores,
            'description' => $request->description,
        ]);

        $performance->save();

        // Return a response
        return response()->json(['message' => 'Employee Performance successfully saved', 'data' => $performance], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $performances = Performance::find($id);
        if (!$performances) {
            return response()->json(['message' => 'Performance not found'], 404);
        }
        return response()->json($performances);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $performances = Performance::find($id);
        if (!$performances ) {
            return response()->json(['message' => 'Employee Performance not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'performance_dates' => 'required',
            'performance_scores' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $performances->update($request->all());

        //return response()->json($employee);
        return response()->json(['message' => 'Employee Performance successfully saved', 'data' => $performances], 201);

    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Performance $performance)
    {
        //
    }

    public function deleteEmployeePerformance($id)
    {

        $performances = Performance::find($id);
        if (!$performances) {
            return response()->json(['message' => 'Employee performance information not found'], 404);
        }
        $performances->delete();
        return response()->json(['message' => 'Employee performance deleted successfully']);
    }
}
