<?php

namespace App\Http\Controllers;

use App\Product;
use App\Project;
use Illuminate\Http\Request;

class ProductController extends Controller
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

        $p = Product::all();

        if ($p){
            return response()->json(['status'=>'Success', 'all'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function create(Request $request, $project){
        $prj = Project::with(['services', 'services.tasks', 'products'])->find($project);
        $p = new Product();
        $p->description = $request->json('description');
        $p->warranty = $request->json('warranty');
        $p->quantity = $request->json('quantity');
        $p->unit_price = $request->json('unit_price');

        if ($prj->products()->save($p)){
            return response()->json(['status'=>'Success', 'product'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function read(Request $request, $id){
        $p = Product::find($id);

        if ($p){
            return response()->json(['status'=>'Success', 'product'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function update(Request $request, $id){
        $p = Product::find($id);
        $p->description = $request->json('description');
        $p->warranty = $request->json('warranty');
        $p->quantity = $request->json('quantity');
        $p->unit_price = $request->json('unit_price');

        if ($p->save()){
            return response()->json(['status'=>'Success', 'product'=>$p]);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }

    public function delete(Request $request, $id){
        $p = Product::find($id);

        if ($p->delete()){
            return response()->json(['status'=>'Success']);
        }else{
            return response()->json(['status'=>'Failed']);
        }
    }
}
