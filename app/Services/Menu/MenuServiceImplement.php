<?php

namespace App\Services\Menu;

use LaravelEasyRepository\Service;
use App\Repositories\Menu\MenuRepository;
use MenuGeneratorResponse;

class MenuServiceImplement extends Service implements MenuService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(MenuRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function generate()
  {
    //   \Menu::make('MyNavBar', function ($menu) {
    //     $menu->add('Home');
    //     $menu->add('About', 'about');
    //     $menu->add('Services', 'services');
    //     $menu->add('Contact', 'contact');
    // });
    $result = $this->mainRepository->allWithClosure(fn ($model) => $model->orderBy('MENU_ID'))->toArray();

    $menuTree = $this->buildTree($result, 0);

    $menuClass = \Menu::new();

    $this->createMenu($menuClass, $menuTree);
    return $menuClass;
  }

  private function buildTree($menus, $menuID = 0)
  {
    $branch = array();
    foreach ($menus as $element) {
      if ($element['MENU_ID_LEADER'] == $menuID) {
        $children = $this->buildTree($menus, $element['MENU_ID']);
        if ($children) {
          $element['children'] = $children;
        }

        $branch[$element['MENU_ID']] = $element;

        unset($menus[$element['MENU_ID']]);
      }
    }
    return $branch;
  }

  private function createMenu($menuClass, $menuTree)
  {
    foreach ($menuTree as $menu) {
      if (isset($menu['children'])) {
        $children = $menu['children'];
        $submenu = \Menu::new();
        foreach ($children as $child) {
          if (isset($child['children'])) {
            $children2 = $child['children'];
            $submenu2 = \Menu::new();
            foreach ($children2 as $child2) {
              $submenu2->link($child2['MENU_PROGRAM'] ?? '#', $child2['MENU_DESC']);
            }
            $submenu->submenu($child['MENU_DESC'], $submenu2);
          } else {
            $submenu->link($child['MENU_PROGRAM'] ?? '#', $child['MENU_DESC']);
          }
        }
        $menuClass->submenu($menu['MENU_DESC'], $submenu);
      } else {
        $menuClass->link($menu['MENU_PROGRAM'] ?? '#', $menu['MENU_DESC']);
      }
    }
  }
}
