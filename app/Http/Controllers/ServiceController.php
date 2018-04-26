<?php

namespace App\Http\Controllers;

use App\Project;
use App\Service;
use App\Product;
use Illuminate\Http\Request;

class ServiceController extends Controller
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

        $s = Service::all();

        if ($s){
            return response()->json(['status'=>'Success', 'all'=>$s]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function create(Request $request, $project){
        $p = Project::with(['services','services.tasks', 'products'])->find($project);
        $s = new Service();
        $s->description = $request->json('description');
        $s->amount = $request->json('amount');

        if ($p->services()->save($s)){
            return response()->json(['status'=>'Success', 'service'=>$s]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function read(Request $request, $id){
        $s = Service::with('tasks')->find($id);

        if ($s){
            return response()->json(['status'=>'Success', 'service'=>$s]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function update(Request $request, $id){
        $s = Service::find($id);
        $s->description = $request->json('description');
        $s->amount = $request->json('amount');

        if ($s->save()){
            return response()->json(['status'=>'Success', 'service'=>$s]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function delete(Request $request, $id){
        $s = Service::find($id);

        if ($s->delete()){
            return response()->json(['status'=>'Success']);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }
}
