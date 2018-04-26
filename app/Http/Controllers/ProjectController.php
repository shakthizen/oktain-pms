<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\HTTP\Request;

class ProjectController extends Controller
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

        $p = Project::all();

        if ($p){
            return response()->json(['status'=>'Success', 'all'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function create(Request $request){
        $p = new Project();
        $p->customer = 'Customer';
        $p->contact = 'contact';
        $p->paid = 0;
        $p->finished = 0;

        if ($p->save()){
            return response()->json(['status'=>'Success', 'project'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function read(Request $request, $id){
        $p = Project::with(['services','services.tasks','products','members'])->find($id);

        if ($p){
            return response()->json(['status'=>'Success', 'project'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function update(Request $request, $id){
        $p = Project::find($id);
        $p->created_at = $request->json('created_at');
        $p->customer = $request->json('customer');
        $p->contact = $request->json('contact');
        $p->paid = $request->json('paid');
        $p->finished = $request->json('finished');

        if ($p->save()){
            return response()->json(['status'=>'Success', 'project'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function delete(Request $request, $id){
        $p = Project::find($id);

        if ($p->delete()){
            return response()->json(['status'=>'Success']);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function addMember(Request $request, $project, $member){
        $p = Project::find($project);
        $m = User::find($member);

        if ($p->members()->save($m)){
            return response()->json(['status'=>'Success']);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function deleteMember(Request $request, $project, $member){
        $p = Project::with('members')->find($project);
        $m = User::find($member);

        if ($p->members()->detach($m)){
            return response()->json(['status'=>'Success']);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }
}
