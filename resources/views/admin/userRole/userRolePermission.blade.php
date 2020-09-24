@extends('admin.layouts.master')

@section('content')
<?php
    use App\UserRoles;
    use App\UserMenu;
    use App\UserMenuActions;
?>

<style type="text/css">
    .parentMenuBlock{
        border: 1px solid #d4c8c8;
        padding: 17px 0px;
        margin-bottom: 20px;
    }
</style>
    <form class="form-horizontal" action="{{ route('userRole.permissionUpdate') }}" method="POST" enctype="multipart/form-data" id="editUser" name="editUser">
        {{ csrf_field() }}
        <input type="hidden" name="userroleId" value="{{$userRoles->id}}">
        <div class="row">
            <div class="col-md-10">
                <label for="select_all">
                    <input type="checkbox" id="select_all" class="select_all" name="select_all"> Select All  
                </label>
                                                      
            </div>
        </div>

        <div style="padding-bottom: 10px;"></div>

        @foreach ($userMenus as $mainMenu)
        @php
            $rolePermission = explode(',', $userRoles->permission);
            if (in_array($mainMenu->id, $rolePermission))
            {
                $checked = "checked";
            }
            else
            {
                $checked = "";
            }
            if($mainMenu->parentMenu == NULL){
            $subMenus = UserMenu::where('parentMenu',$mainMenu->id)->get();                                       
        @endphp
            <div class="row parentMenuBlock">
                <div class="col-md-12">
                    <label>
                        <input class="parentMenu_{{$mainMenu->parentMenu}} menu" type="checkbox" name="usermenu[]" value="{{$mainMenu->id}}" {{$checked}}  data-id="{{$mainMenu->id}}">
                        <span>{{$mainMenu->menuName}}</span>
                    </label>
                  
                    <div class="row" style="padding-left: 60px;">
                        @foreach ($subMenus as $menu)
                            @php
                                $userMenuAction = UserMenuActions::where('actionStatus',1)->orderBy('orderBy','ASC')->where('parentmenuId',$menu->id)->get();
                                $rolePermission = explode(',', $userRoles->permission);
                                if (in_array($menu->id, $rolePermission))
                                {
                                    $checked = "checked";
                                }
                                else
                                {
                                    $checked = "";
                                }                                            
                            @endphp

                            <div class="col-md-3" style="margin-bottom: 12px;">
                                <label>
                                    <input class="parentMenu_{{$menu->parentMenu}} menu" type="checkbox" name="usermenu[]" value="{{$menu->id}}" {{$checked}}  data-id="{{$menu->id}}">
                                    <span>{{$menu->menuName}}</span>
                                </label>
                                <div style="margin-left: 26px;margin-top: 3px;">
                                    @foreach ($userMenuAction as $action)
                                        @php
                                            $actionPermission = explode(',', $userRoles->actionPermission);
                                            if (in_array($action->id, $actionPermission))
                                            {
                                                $actionChecked = "checked";
                                            }
                                            else
                                            {
                                                $actionChecked = "";
                                            }                                                    
                                        @endphp
                                        <label style="display: block;">
                                            <input class="childMenu_{{$action->parentmenuId}} parentMenu_{{$menu->parentMenu}}" type="checkbox" name="usermenuAction[]" value="{{$action->id}}" style="margin-bottom: 8px;" {{$actionChecked}}> {{$action->actionName}} <br>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @php
                }
            @endphp
        @endforeach

        <div class="row">
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect">Update</button> 
            </div>
        </div>
    </form>
<script src="{{ asset('/public/admin-elite/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
 <script type="text/javascript">
   $(document).ready(function(){
        $('.select_all').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        });

        $('.menu').click(function(event) {
            var menuId = $(this).data('id');
            if(this.checked) {
                $('.parentMenu_'+menuId).each(function() {
                    this.checked = true; 

                });

                $('.childMenu_'+menuId).each(function() {
                    this.checked = true; 

                });
            }else{
              $('.parentMenu_'+menuId).each(function() {
                    this.checked = false; 
                });

              $('.childMenu_'+menuId).each(function() {
                    this.checked = false; 

                });
            }
         });

    });

    document.forms['editUser'].elements['role'].value = "{{$userRoles->role}}";
    
</script>

@endsection


