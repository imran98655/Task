<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Redirect;

class TaskController extends Controller
{
  private $taskName;
  private $taskModel;
  private $insertTask;
  private $fetchTask;

  public function __construct(Request $request)
  {
    $this->taskModel = new \App\Services\TaskModel();
    
  }
  public function index(){
   
    return view('welcome');
  }
  public function show(Request $request)
  {
   
   $this->taskName = $request->input('task_name');
   $this->insertTask =$this->taskModel->insert($this->taskName);
   return view('welcome');
  }
  public function fetchTask(){
    
    $this->fetchTask = $this->taskModel->fetchRecords();
    // var_dump(response()->json($this->fetchTask));
    return response()->json($this->fetchTask);
  } 
  public function deleteTask(Request $request){

    $taskName = $request->input('taskName');
    $this->fetchTask = $this->taskModel->deleteRecord($taskName);

  }
}
