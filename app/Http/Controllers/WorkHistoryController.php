<?php

namespace App\Http\Controllers;

use App\Models\WorkHistory;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WorkHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function store(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'job_title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
           
        ]);

       // Check if validation fails
       if ($validator->fails() || $id == 0) {
        return response()->json($validator->errors(), 400);

    }
   

    if ($request->id != 0) {
        $contact = WorkHistory::find($request->id);
        if (!$contact) {
            return response()->json(['message' => 'Emergency contact information not found'], 404);
        }
        $contact->update($request->all());
        return response()->json($contact);
    } else {
        $contact = WorkHistory::create($request->all());
        return response()->json($contact, 201);
    }
        



    }
 public function storeWorkHistory(Request $request, $id)
    {
     
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        

     
        $workhistory =  DB::table('work_history')
                        ->where('work_history.employee_id', $id)
                        ->join('departments', 'departments.id', '=', 'work_history.department_id')
                        ->selectRaw('work_history.*,departments.name')
                        ->get();

        
       // $workhistory = WorkHistory::where('employee_id', $id)->get();
        // dd($contacts);
        return response()->json($workhistory);


      
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkHistory $workHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkHistory $workHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkHistory $workHistory)
    {
        //
    }

    public function deleteWorkHistory($id){

        $contact = WorkHistory::find($id);
        if (!$contact) {
            return response()->json(['message' => 'Work History information not found'], 404);
        }
        $contact->delete();
        return response()->json(['message' => ' deleted successfully']);
    }
}
