<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FoodMenuModel;

class FoodMenuController extends Controller
{
  
    public function food_menu_index(Request $request)
    {
        $getrecord = FoodMenuModel::orderBy('id', 'desc');
        // Search Box Start
        if(!empty($request->idsss)){
         $getrecord = $getrecord->where('food_menu.id', '=', $request->idsss);
        }
        if(!empty($request->westway_food_menu_name)){
         $getrecord = $getrecord->where('food_menu.food_menu_name', 'like', '%' .$request->food_menu_name. '%');
        }
        // Search Box End
        $getrecord = $getrecord->paginate(40);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = 'Food Menu List';
        return view('backend.food_menu.list', $data);
    }

 
    public function food_menu_create(Request $request)
    {
        $data['meta_title'] = 'Add Food Menu';
        return view('backend.food_menu.add', $data);
    }

    
    public function food_menu_store_update($id = '', Request $request)
    {
        if(!empty($id)){
            $insert_update = FoodMenuModel::get_single($id);
        }else{
            $insert_update = new FoodMenuModel;
        }
        $insert_update->food_menu_name     = $request->food_menu_name;
        $insert_update->save();
        return redirect('admin/food_menu')->with('success',"Record successfully register.");
    }

  
    
    public function food_menu_store_edit($id)
    {
        $data['getrecord'] = FoodMenuModel::get_single($id);
        $data['meta_title'] = 'Edit Food Menu';
        return view('backend.food_menu.edit', $data);
    }
    
    public function food_menu_store_destroy($id)
    {
        $destroy_recoard = FoodMenuModel::get_single($id);
        $destroy_recoard->delete();
        return redirect()->back()->with('error', 'Record successfully deleted!');
    }

}
