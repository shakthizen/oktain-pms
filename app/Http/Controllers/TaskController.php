<?php

namespace App\Http\Controllers;

use App\Service;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){

        $t = Task::all();

        if ($t){
            return response()->json(['status'=>'Success', 'all'=>$t]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function create(Request $request, $service){
        $s = Service::with(['tasks'])->find($service);
        $t = new Task();
        $t->description = $request->json('description');

        if ($s->tasks()->save($t)){
            return response()->json(['status'=>'Success', 'task'=>$t]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function read(Request $request, $id){
        $t = Task::find($id);

        if ($t){
            return response()->json(['status'=>'Success', 'task'=>$t]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function update(Request $request, $id){
        $t = Task::find($id);
        $t->description = $request->json('description');

        if ($t->save()){
            return response()->json(['status'=>'Success', 'task'=>$t]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function delete(Request $request, $id){
        $t = Task::find($id);

        if ($t->delete()){
            return response()->json(['status'=>'Success']);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }
}
