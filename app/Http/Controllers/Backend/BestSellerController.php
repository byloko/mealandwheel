<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WestwayFoodBestSellerModel;
use App\FoodMenuModel;

class BestSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function best_seller_index(Request $request)
    {
        $getrecord = WestwayFoodBestSellerModel::orderBy('id', 'desc');
        // ->select('westway_food_best_seller.*');
        // $getrecord = $getrecord->join('food_menu', 'westway_food_best_seller.westway_food_menu_id', '=', 'westway_food_menu.id'); 
        // Search Box Start
        // if(!empty($request->idsss)){
        //   $getrecord = $getrecord->where('westway_food_best_seller.id', '=', $request->idsss);  
        // }

        // if (!empty($request->westway_food_menu_id)) {
        //     $getrecord = $getrecord->where('food_menu.food_menu_name', 'like', '%' . $request->westway_food_menu_id . '%');
        // }

        // if(!empty($request->food_name)){
        //     $getrecord = $getrecord->where('westway_food_best_seller.food_name', 'like', '%' .$request->food_name. '%');
        // }

        // if(!empty($request->category_name)){
        //     $getrecord = $getrecord->where('westway_food_best_seller.category_name', 'like', '%' .$request->category_name. '%');
        // }

        // if(!empty($request->price)){
        //     $getrecord = $getrecord->where('westway_food_best_seller.price', 'like', '%' .$request->price. '%');
        // }
        // Search Box End
        $getrecord = $getrecord->paginate(40);
        $data['getrecord'] = $getrecord;
        $data['meta_title'] = 'Best Seller List';
        return view('backend.best_seller.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function best_seller_create()
    {
       $data['getwestwayfoodmenu'] = FoodMenuModel::get();
       $data['meta_title'] = 'Add Best Seller';
       return view('backend.best_seller.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function best_seller_store(Request $request)
    {
        // dd($request->all());
        $inser_best                       = new WestwayFoodBestSellerModel;
        
        if (!empty($request->file('food_image'))) {
            $ext = 'jpg';
            $file = $request->file('food_image');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/food/', $filename);
            $inser_best->food_image = $filename;
        }

        $inser_best->westway_food_menu_id = trim($request->westway_food_menu_id);
        $inser_best->food_name            = trim($request->food_name);
        $inser_best->category_name        = trim($request->category_name);
        $inser_best->price                = trim($request->price);
        $inser_best->save();
        return redirect('admin/best_seller')->with('success', 'Record successfully register.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function best_seller_edit($id)
    {
      $data['getwestwayfoodmenu'] = FoodMenuModel::get();
      $data['getrecord']          = WestwayFoodBestSellerModel::get_single($id);
      $data['meta_title'] = 'Edit Best Seller';
      return view('backend.best_seller.edit', $data);
    }

    public function best_seller_update(Request $request, $id)
    {
        // dd($request->all());

        $update_seller = WestwayFoodBestSellerModel::get_single($id);

        if (!empty($request->file('food_image')))
        {
            if (!empty($update_seller->food_image) && file_exists('upload/food/'.$update_seller->food_image))
            {
                unlink('upload/food/'.$update_seller->food_image);
            }
            $ext = 'jpg';
            $file = $request->file('food_image');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/food/', $filename);
            $update_seller->food_image = $filename;
        }


        $update_seller->westway_food_menu_id = $request->westway_food_menu_id;
        $update_seller->food_name            = $request->food_name;
        $update_seller->category_name        = $request->category_name;
        $update_seller->price                = $request->price;
        $update_seller->save();
        return redirect('admin/best_seller')->with('success', 'Record successfully register.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function best_seller_destroy($id)
    {
        $delete_best = WestwayFoodBestSellerModel::get_single($id);
        $delete_best->delete();
        return redirect()->back()->with('error', 'Record successfully deleted!');

    }
}
