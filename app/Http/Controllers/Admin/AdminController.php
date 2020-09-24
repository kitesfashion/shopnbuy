<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

use App\Admin;
use App\UserRoles;
use App\DeliveryZone;

class AdminController extends Controller
{
    public function index($id = NULL){   
        $title = "User List";

        $roleId =  Auth::user()->role;
        $currentRole = UserRoles::where('id',$roleId)->first();

        $userList = Admin::where('roleLevel','>=',$currentRole->level)
                        ->orderBy('roleLevel','ASC')->get();
               
       return view('admin.users.index')->with(compact('title','userList'));
    }

    public function adduser(){
        $title = "Add New User";

        $roleId =  Auth::user()->role;
        $currentRole = UserRoles::where('id',$roleId)->first();
        
        $userRoles = UserRoles::where('level','>=',$currentRole->level)->orderBy('level','ASC')->get();

        $deliveryZoneList = DeliveryZone::all();
        return view('admin.users.adduser')->with(compact('title','userRoles','deliveryZoneList'));
    }

    public function saveuser(Request $request){
        $this->validation($request);

        $roleInfo = UserRoles::where('id',$request->role)->first();

        $users = Admin::create( [     
            'name' => $request->name,           
            'email' => $request->email,           
            'username' => $request->username,
            'delivery_zone_id' => $request->delivery_zone_id,           
            'role' => $request->role,             
            'roleName' => $roleInfo->name,             
            'roleLevel' => $roleInfo->level,            
            'password' => bcrypt($request->password),             
            'status' => '1',             
                      
        ]);

        return redirect(route('users.index'))->with('msg','User Added Successfully');     
    }

    public function edituser($id){
        $title = "Edit User";

        $roleId =  Auth::user()->role;
        $currentRole = UserRoles::where('id',$roleId)->first();

        $userRoles = UserRoles::where('level','>=',$currentRole->level)->orderBy('level','ASC')->get();
        $users = Admin::where('id',$id)->first();
        $deliveryZoneList = DeliveryZone::all();
        return view('admin.users.updateuser')->with(compact('title','users','userRoles','deliveryZoneList'));
    }

    public function UserAccount(){
        $id =  Auth::user()->id;
        $users = Admin::where('id',$id)->first();
        return view('admin.users.account')->with(compact('users'));
    }

   
    public function updateuser(Request $request){
        $userId = $request->userId;
        $users = Admin::find($userId);

        $roleInfo = UserRoles::where('id',$request->role)->first();

        if($request->userAccount){
           $this->validate(request(), [
                'name' => 'required',
                'email' => 'required',
                'username' => 'required',
                'password' => 'required|string|min:6',
            ]); 

           $users->update( [
                'name' => $request->name,  
                'email' => $request->email,           
                'username' => $request->username,   
                'password' => bcrypt($request->password),             
            ]);

           return redirect(route('user.account'))->with('msg','Account Updated Successfully')->with(compact('users'));
        }else{
            $this->validate(request(), [
                'role' => 'required',
                'name' => 'required',
                'email' => 'required',
                'username' => 'required',
                
            ]);

            $users->update( [
                'name' => $request->name,  
                'email' => $request->email,           
                'username' => $request->username,
                'delivery_zone_id' => $request->delivery_zone_id,   
                'role' => $request->role,             
                'roleName' => $roleInfo->name,             
                'roleLevel' => $roleInfo->level,             
            ]);  

            return redirect(route('users.index'))->with('msg','User Updated Successfully'); 
        }     
    }


     public function password($id){
        $title = "Change Password";
        $users = Admin::where('id',$id)->first();
        return view('admin.users.changePassword')->with(compact('title','users'));
    }

    public function passwordChange(Request $request){
        $this->validate(request(), [
            'password' => 'required|string|min:6',  
        ]);

        $userId = $request->userId;
        $users = Admin::find($userId);

        $users->update( [               
            'password' => bcrypt($request->password),                
        ]);

        return redirect(route('users.index'))->with('msg','Password Changed Successfully');     
    }

    public function changeuserStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = Admin::find($request->user_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('users.index')) -> with( 'message', 'Wrong move!');
    }

    
    public function destroy(Admin $user, Request $request)
    {
        if($request->ajax())
        {
            $user->delete();
            print_r(1);       
            return;
        }

        $user->delete();
        return redirect(route('users.index')) -> with( 'message', 'Deleted Successfully');
    }

    public function NoPermission(){
        return view('admin.users.noPermission');
    }


    public function validation(Request $request)
    {
        $this->validate(request(), [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);
    }
}
