<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

use App\UserRoles;
use App\UserMenu;


class UserRoleController extends Controller
{
   
    public function index()
    {   
        $title = "User Role";

        $roleId =  Auth::user()->role;
        $currentRole = UserRoles::where('id',$roleId)->first();
        $userRoles = UserRoles::where('level','>=',$currentRole->level)->orderBy('level','ASC')->get();

       return view('admin.userRole.index')->with(compact('title','userRoles'));
    }

    public function adduserRole(){
        $title = "Add New User Role";

        $roleId =  Auth::user()->role;
        $currentRole = UserRoles::where('id',$roleId)->first();

        $userRoleList = UserRoles::where('level','>=',$currentRole->level)->orderBy('level','ASC')->get();
        return view('admin.userRole.adduserRole')->with(compact('title','userRoleList'));
    }

    public function saveuserRole(Request $request){
        $this->validation($request);

        if(!$request->parentRole){
            $level = '1';
        }elseif($request->parentRole){
            $parentRoleInfo = UserRoles::where('id',$request->parentRole)->first();
            $level = $parentRoleInfo->level + 1;
        }
        $userRoles = UserRoles::create( [     
            'name' => $request->name,                   
            'level' => $level,                   
            'parentRole' => $request->parentRole,                      
            'status' => '0',             
                      
        ]);

        return redirect(route('user-roles.index'))->with('msg','User Role Added Successfully');     
    }

    public function edituserRole($id){
        $title = "Edit User Role";

        $roleId =  Auth::user()->role;
        $currentRole = UserRoles::where('id',$roleId)->first();

        $userRoleList = UserRoles::where('level','>=',$currentRole->level-1)->orderBy('level','ASC')->get();

        $userRoles = UserRoles::where('id',$id)->first();
        return view('admin.userRole.updateuserRole')->with(compact('title','userRoleList','userRoles'));
    }
   
    public function updateuserRole(Request $request){
        $this->validate(request(), [          
            'name' => 'required',
        ]);

        $userroleId = $request->userroleId;
        $userRoles = UserRoles::find($userroleId);

        if(!$request->parentRole){
            $level = '1';
        }elseif($request->parentRole){
            $parentRoleInfo = UserRoles::where('id',$request->parentRole)->first();
            $level = $parentRoleInfo->level + 1;
        }

        $userRoles->update( [
            'name' => $request->name,                   
            'level' => $level,                     
            'parentRole' => $request->parentRole,                     
        ]);

        $affectedChildRole = DB::table('user_roles')
                            ->where('parentRole', '=', $userRoles->id)
                            ->update(array('level' => $level+1));

        return redirect(route('user-roles.index'))->with('msg','User Role Updated Successfully');     
    }

    public function changeuserRoleStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = UserRoles::find($request->userRole_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('user-roles.index')) -> with( 'message', 'Wrong move!');
    }

    public function destroy(UserRoles $userRole, Request $request)
    {
        if($request->ajax())
        {
            $userRole->delete();
            print_r(1);       
            return;
        }

        $admin->delete();
        return redirect(route('users.index')) -> with( 'message', 'Deleted Successfully');
    }


    public function validation(Request $request)
    {
        $this->validate(request(), [  
            'name' => 'required',

        ]);
    }

    public function permission($id){
        $userMenus = UserMenu::orderBy('id','ASC')->where('menuStatus',1)->get();
        $userRoles = UserRoles::where('id',$id)->first();
        return view('admin.userRole.userRolePermission')->with(compact('userRoles','userMenus'));
    }

    public function permissionUpdate(Request $request){
        $userroleId = $request->userroleId;
        $userRoles = UserRoles::find($userroleId);
       
            $usermenus = implode(',', $request->usermenu);
        
        if(@$request->usermenuAction){
            $usermenuAction = implode(',', @$request->usermenuAction);
        }else{
            $usermenuAction = '';
        }
        $userRoles->update( [
            'permission' => @$usermenus,                     
            'actionPermission' => @$usermenuAction,                     
        ]);

        return redirect(route('user-roles.index'))->with('msg','User Role Permission Updated Successfully');     
    }
}
