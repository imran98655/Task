<?php

namespace App\Services;

use DB;


class TaskModel
{
    private $conn;
    public function __construct()
    {
       
    }

  
    public function insert($task)
    {    
        if($task !=''){
            $result = DB::table('task_description')->insert([
            'task_name' => $task,
            'created_at' => time(),
            'updated_at' => time()
            ]);
        }
       
    }
    public function fetchRecords(){
        $tasks = DB::table('task_description AS tp')
        ->select('task_name')
        ->distinct()
        ->get();
        return $tasks;
    }
    public function deleteRecord($taskName){
        
        $deleted = DB::table('task_description AS tp')
            ->where('task_name', $taskName)
            ->delete();
            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => "Task '$taskName' has been deleted."
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Task '$taskName' not found or could not be deleted."
                ]);
            }
        }
}
  
