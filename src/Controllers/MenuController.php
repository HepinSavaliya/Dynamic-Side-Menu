<?php

namespace Player\Sidemenu\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Player\Sidemenu\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menuModel = new Menu();
        $menuTree = $menuModel->getMenuTree(); 
        return view('sidemenu.sort',compact('menuTree'));
    }

    public function changeSideMenuOrder(Request $request)
    {
        $menus = $request->menuStructure;
        foreach ($menus as $menuData) {
            $menu = Menu::findByMenuId($menuData['menu_id']);
            $menu->parent_menu_id = $menuData['parent_menu_id']; 
            $menu->order = $menuData['order']; 
            $menu->save();
        }
    
        return response()->json(['success' => true]);
    }
}
