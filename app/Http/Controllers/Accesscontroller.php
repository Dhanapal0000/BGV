<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\TBgVendor;


class Accesscontroller extends Controller
{
    public function login(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 422], 422);
        }

        $user_name = $request['username'];
        $password = $request['password'];
        
        
        // Query the database
        $r = DB::table('t_bgvendor')->select('login', 'password', 'vendorname', 'companyid', 'status', 'role', 'logo')
        ->where([
            ['login', '=', $user_name],
            ['password', '=', $password],
        ])->first();
    
    if ($r) {
        // If the logo exists, encode it in base64
        if (isset($r->logo)) {
            $r->logo = base64_encode($r->logo);
        }
    
        // Set up the success response
        $success['bgv'] = $r;
        
        return response()->json(['data' => $success, 'status' => 200], 200);
    } else {
        return response()->json(['error' => 'Invalid credentials', 'status' => 500], 500);
    }
}

    public function useradd(Request $request)
    {
        // Validate request inputs
        $validator = Validator::make($request->all(), [
            'Username' => 'required',
            'password' => 'required',
            'logo' => 'required',
            'vendorname' => 'required',
            'role' => 'required',
            'companyid' => 'required',
        ]);

    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $userName = $request->input('Username');
    
        // Check if the username already exists in the t_bgvendor table
        $existingUser = DB::table('t_bgvendor')->where('login', $userName)->first();
    
        if (!$existingUser) {
            // Create new entry in t_bgvendor table
            $staff = new TBgVendor;
            $staff->login = $userName;
            $staff->password = $request->input('password'); // Secure password storage
            $staff->logo = $request->input('logo');
            $staff->vendorname = $request->input('vendorname');
            $staff->role = $request->input('role');
            $staff->companyid = $request->input('companyid');
    
        
    
            $staff->save();
    
            // Update role status in the `t_bgvendor` table based on the role
          
    
            return response()->json(['message' => 'Inserted successfully']);
        } else {
            return response()->json(['error' => 'invalied user username.'], 409);
        }
    }
    

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Username' => 'required',
            'password' => 'required',
            'logo' => 'required',
            'vendorname' => 'required',
            'role' => 'required',
            'companyid' => 'required',
        ]);

    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $userName = $request->input('Username');
    
        // Check if the username already exists in the t_bgvendor table
        $existingUser = DB::table('t_bgvendor')->where('login', $userName)->first();
    
        if (!$existingUser) {
            // Create new entry in t_bgvendor table
            $staff =  TBgVendor::find($id);
            $staff->login = $userName;
            $staff->password = $request->input('password'); // Secure password storage
            $staff->logo = $request->input('logo');
            $staff->vendorname = $request->input('vendorname');
            $staff->role = $request->input('role');
            $staff->companyid = $request->input('companyid');
    
        
    
            $staff->save();
    
            // Update role status in the `t_bgvendor` table based on the role
          
    
            return response()->json(['message' => 'Updated successfully']);
        } else {
            return response()->json(['error' => 'invalied user username.'], 409);
        }
    }

    public function UserEdit(Request $request, $id)
    {
        $staff = TBgVendor::select('id', 'login', 'password', 'vendorname', 'companyid', 'role', 'logo')
        ->where('id', $id)
        ->first();

        if($staff)
        { 
            return response()->json(['data' => $staff, 'status' => 200], 200);
        }
        else{
            return response()->json(['error' => 'invalied '], 409);
        }

    }

    public function UserDelete(Request $request, $id)
    {
     
        TBgVendor::where('id',$id)->delete();
        return response()->json(['Message' =>'Delete Sucessfully','status' => 200], 200);
    }
}