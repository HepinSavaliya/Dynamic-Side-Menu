<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Player\Sidemenu\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'title' => 'Dashboard',
                'html' => '<i class="fa fa-dashboard"></i>',
                'menu_id' => 'dashboard',
                'parent_menu' => null,
                'order' => 1,
                'route' => 'dashboard.index',
                'class' => 'dashboard-class',
                'permission' => ['view_dashboard'],
                'user_type' => 'super-admin'
            ],
            // Add more menus as needed
        ];

        foreach ($menus as $menu) {
            if (!isset($menu['title'], $menu['html'], $menu['menu_id'])) {
                continue;
            }

            if (preg_match('/<script|<link/i', $menu['html'])) {
                continue;
            }

            if (!isset($menu['order'])) {
                $menu['order'] = 0;
            }

            if (isset($menu['parent_menu']) && !Menu::where('menu_id', $menu['parent_menu'])->exists()) {
                continue;
            }

            Menu::create($menu);
        }
    }
}
