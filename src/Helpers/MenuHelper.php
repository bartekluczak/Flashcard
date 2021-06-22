<?php

namespace App\Helpers;

class MenuHelper
{
    private $menuItems = array(
        array('name' => 'Learn', 'order' => 0, 'url' => '/learn', 'active' => false),
        array('name' => 'Groups', 'order' => 1, 'url' => '/group', 'active' => false),
        array('name' => 'Statistics', 'order' => 2, 'url' => '/statistics', 'active' => false),
        array('name' => 'Logout', 'order' => 3, 'url' => '/logout', 'active' => false)
    ); 

    public function getMenu($name) {
        $menu = $this->menuItems;
        for ($i = 0; $i < count($menu); $i++){
            if($menu[$i]['name'] == $name){
                $menu[$i]['active'] = true;
            }
        }
        return $menu;
    }
}