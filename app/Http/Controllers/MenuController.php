<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function store(Request $request)
    {
        $Q_menus = Menu::get();

        $count_menu = 1;
        if ($Q_menus) {
            foreach ($Q_menus as $menu) {
                $data_menu[$menu->number_sort] = $menu;
                $menu_array = $menu->toArray();
                if ((int)$menu->number_sort  >= (int)$request->number_sort) {
                    $count_menu++;
                    $menu_array['number_sort'] = $count_menu;
                    Menu::updateOrCreate(
                        ['uuid' => $menu->uuid],
                        [
                            'number_sort' => $count_menu
                        ]
                    );
                    $count_menu--;
                }
                $count_menu++;
            }
        }

        $request['uuid'] = ResponseFormatter::toUUID($request->description);
        $store = Menu::updateOrCreate(['uuid' => $request['uuid']], $request->all());
        return ResponseFormatter::ResponseJson($store, "store menu", 200);
    }

    public function get(Request $request){
        if($request->uuid){
            $data_menu = Menu::where('uuid',$request->uuid)->first();
        }else{
            $Q_menus = Menu::orderBy('number_sort','ASC')->get();
            $data_menu = [];
            foreach ($Q_menus as $menu) {                
                $data_menu[] = $menu;
            }
        }
        return ResponseFormatter::ResponseJson($data_menu, "store menu", 200);
    }

    public function delete(Request $request){
        $to_delete = Menu::where('uuid', $request->uuid)->first();
        $post = Menu::where('uuid', $request->uuid)->delete();
        $Q_menus = Menu::get();
        if ($Q_menus) {
            foreach ($Q_menus as $menu) {
                $data_menu[$menu->number_sort] = $menu;
                if ((int)$menu->number_sort  > (int)$to_delete->number_sort) {
                    Menu::updateOrCreate(
                        ['uuid' => $menu->uuid],
                        [
                            'number_sort' => ($menu->number_sort - 1)
                        ]
                    );
                }
            }
        }


        return ResponseFormatter::ResponseJson($post, "store menu", 200);
    }
}
