<?php

namespace App\Http\Controllers;

use App\Models\ManagerPrice as ModelsManagerPrice;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class ManagerPrice extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $managerPrices = ModelsManagerPrice::with(['user', 'user_group'])->get();

         $users = User::all();
         $user_groups = UserGroup::all();

        return view('admin.ManagerPrice',compact('managerPrices','users','user_groups'));
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
    public function store(Request $request)
    {
        $managerId = $request->id;
        $managerPrice = ModelsManagerPrice::updateOrCreate(
          [
        'name' => $request->name,
        'user_id' => $request->user_id,
        'manager_id' => $request->manager_id
        ],
        [
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status
        ]);
        return Response()->json($managerPrice);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $managerPrice = ModelsManagerPrice::where('id',$id)->first();
        return Response()->json($managerPrice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = array('id' => $request->id);
        $managerPrice = ModelsManagerPrice::where('id',$id)->first();

        if($managerPrice){
            $managerPrice->delete();
            return Response()->json([
                'message' => 'Xoa thanh cong',
                
            ],200);
        }
        return Response()->json([
            'error' => 'Xoa that bai',
            
        ],400);
    }
}
