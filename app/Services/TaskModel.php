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
        ->select('id','task_name')
        ->distinct('task_name')
        ->get();
        return $tasks;
    }
    public function deleteRecord($id){
        
        DB::table('task_description')
        ->where('id', '=', $id)
        ->delete();
        return true;
        }
}
  
