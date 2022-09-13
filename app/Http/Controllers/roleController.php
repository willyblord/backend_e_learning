<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\Role;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class roleController extends Controller
{
    //
    public function roleCreate(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:role',
            ]);
            if($validator->fails()) {
                return response()->json([
                    'message' => 'role Exist',
                    'user' => $role
                ], 201);
            }
    
            $role = Role::create([
                'title' => $request -> title
                ]);
            return response()->json([
                'message' => 'role registered',
                'user' => $role
            ], 201);
        }
    }
    // edit
    // selecting role
    public function getRole(){
        return response()->json(Role::all(),200);
    }
    public function getRolebyId($id){
        $data = Role::find($id);
        if(is_null($data)){
            return response()->json(['message' => 'role not found'],404);
        }
        return response()->json(Role::find($id),200);
    }

    public function deleteRole(Request $request, $id){
        $roledelete = Role::find($id);
        if(is_null($roledelete)){
            return response()->json(['message' => 'delete not found'],404);
        }
        $roledelete->delete();
        return response(null,200);
    }

}
