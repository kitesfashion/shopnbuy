<?php

namespace App\Helper;

use Intervention\Image\ImageManagerStatic as Image;
use  File;
use App\UserRoles;
use App\Admin;
use Auth;

class UserList
{
   public static function roleMenus($parent = null) {
        $data = UserRoles::where('parentRole',$parent)
                        ->where('status','1')
                        ->orderby('id','ASC')
                        ->get();
        $menu_data = array();
        foreach ($data as $menus) :
            $menu_data[] = array(
                'id' => $menus['id'],
                'name' => $menus['name'],
                'status' => $menus['status'],
                'sub_menu' => self::roleMenus($menus['id']),
            );

        endforeach;
        return $menu_data;
    }

    public static function roleGetDataMenuUser($parent = "0", $globalMenu = NULL) {
        $globalMenu = $globalMenu;
        if (!empty($globalMenu)) {
            $html = '';
            foreach ($globalMenu as $value) {
                if (!empty($value['sub_menu'])) {
                    $mylink = 'trigger right-caret';
                } else {
                    $mylink = NULL;
                }
                $html .= '<li>';
                $html .= '<a href="javascript:void(0)" class="'.$mylink.' my-link">'.$value['name'].'</a>';
                
                $users = Admin::where('role',$value['id'])->get();
                $html .= '<table class="table table-bordered table-striped"><thead><tr>';
                $html .= '<th width="35%">Username</th>';
                $html .= '<th width="35%">Email</th>';
                $html .= '<th width="8%">Status</th>';
                $html .= '<th width="15%" style="text-align:center">Actions</th>';
                $html .= '</tr>';
                $html .= '</thead>';
                if (!empty($users)) {
                    foreach ($users as $user) {
                        $html .= '<tbody><tr class="row_'.$user->id.'">';
                        $html .= '<td>' . $user->username . '</td>';
                        $html .= '<td>' . $user->email . '</td>';
                        $html .= '<td>'.\App\Helper\UserLink::status($user->id,$user->status).'</td>';
                        $html .= '<td style="text-align:center">'.\App\Helper\UserLink::action($user->id).'</td>';
                        $html .= '</tr>';
                        $html .= '</tbody>';
                    }
                }
                $html .='</table>';
                $html .= self::roleSubMenuUser($value['sub_menu'], $value['id']);
                $html .='</li>';
            }

            $globalMenu = $html;
        }


        return $globalMenu;
    }

    public static function roleSubMenuUser($data = NULL, $id = NULL) {
        if ($data == NULL)
            return;
        $html = "";
        $html.='<ul class="dropdown-menuC sub-menu">';
        foreach ($data as $value) {
            if (!empty($value['sub_menu'])) {
                $mylink = 'trigger right-caret';
            } else {
                $mylink = NULL;
            }
            $html .= '<li>';
            $html .= '<a href="javascript:void(0)" class="'.$mylink.' my-link">'.$value['name'].'</a>';
            
            $users = Admin::where('role',$value['id'])->get();
            $html .= '<table class="table table-bordered table-striped"><thead><tr>';
            $html .= '<th width="35%">Username</th>';
            $html .= '<th width="35%">Email</th>';
            $html .= '<th width="8%">Status</th>';
            $html .= '<th width="15%" style="text-align:center">Actions</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            if (!empty($users)) {
                foreach ($users as $user) {
                    $html .= '<tbody><tr class="row_'.$user->id.'">';
                    $html .= '<td>' . $user->username . '</td>';
                    $html .= '<td>' . $user->email . '</td>';
                    $html .= '<td>'.\App\Helper\UserLink::status($user->id,$user->status).'</td>';
                    $html .= '<td style="text-align:center">'.\App\Helper\UserLink::action($user->id).'</td>';
                    $html .= '</tr>';
                    $html .= '</tbody>';
                }
            }
            $html .='</table>';
            $subchild = self::roleSubMenuUser($value['sub_menu'], $value['id']);
            if ($subchild != '') {
                $html .= $subchild;
            }
            $html .='</li>';
        }
        $html.='</ul>';
        return $html;
    }
}
