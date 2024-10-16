<?php

namespace Player\Sidemenu\Models;
use Player\Sidemenu\Models\Menu as ModelsMenu;

class Menu extends ModelsMenu
{
    public function getMenuTree()
    {
        $menus = static::all()->toArray();

        return $this->buildTree($menus);
    }

    private function buildTree($menus, $parentId = null)
    {
        $branch = [];

        foreach ($menus as $menu) {
            if ($menu['parent_menu_id'] == $parentId) {
                $children = $this->buildTree($menus, $menu['menu_id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $branch[] = $menu;
            }
        }

        return $branch;
    }
}