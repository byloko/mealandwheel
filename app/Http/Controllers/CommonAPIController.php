<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\VersionSettingModel;
use App\WestwayFoodMenuModel;
use App\WestwayFoodBestSellerModel;
use App\UserSliderModel;
use App\OrderModel;
use App\ProductModel;
use File;
use Str;

trait CommonAPIController{

	public function getProfileUser($id)
	{
		$user 						= User::find($id);
		$json['user_id'] 			= $user->id;
		$json['name'] 				= !empty($user->name) ? $user->name : '';
		$json['lastname'] 			= !empty($user->lastname) ? $user->lastname : '';
		$json['email'] 			    = !empty($user->email) ? $user->email : '';
		$json['user_profile']       = !empty($user->user_profile) ? $user->user_profile : '';
		$json['identity_proof']     = !empty($user->identity_proof) ? $user->identity_proof : '';
		$json['address']            = !empty($user->address) ? $user->address : '';
		$json['mobile'] 			= !empty($user->mobile) ? $user->mobile : '';
		$json['otp'] 		    	= !empty($user->otp) ? $user->otp : '';
		$json['otp_verify']         = !empty($user->otp_verify) ? $user->otp_verify : '';
		$json['social_type'] 		= !empty($user->social_type) ? $user->social_type : '';
		$json['social_id'] 		    = !empty($user->social_id) ? $user->social_id : '';

		$json['account_number'] 	= !empty($user->account_number) ? $user->account_number : '';
		$json['bank_name'] 		    = !empty($user->bank_name) ? $user->bank_name : '';
		$json['ifsc_code'] 		    = !empty($user->ifsc_code) ? $user->ifsc_code : '';
		$json['account_holder_name']= !empty($user->account_holder_name) ? $user->account_holder_name : '';
		$json['branch_name'] 		= !empty($user->branch_name) ? $user->branch_name : '';
		$json['token'] 		        = !empty($user->token) ? $user->token : '';
		
		$json['total_balance'] 		        = !empty($user->total_balance) ? $user->total_balance : '0';
		
		$result = array();

		
		$getRecord = UserSliderModel::where('user_id', '=', $user->id)->get();
		foreach ($getRecord as $kevalue) {
			$data['id']		        = !empty($kevalue->id) ? $kevalue->id : '';
			$data['user_id']		= !empty($kevalue->user_id) ? $kevalue->user_id : '';
			$data['slider_pic']		= !empty($kevalue->slider_pic) ? $kevalue->slider_pic : '';
			$result[] = $data;
		}
		$json['home_slider_image'] = $result;
		
		return $json;
	}

	public function getProductList($id){
		$getProduct = ProductModel::find($id);
		$json['id'] = $getProduct->id;
		$json['user_id'] = $getProduct->user_id;
		$json['product_name'] = !empty($getProduct->product_name) ? $getProduct->product_name : '';
		$json['product_description'] = !empty($getProduct->product_description) ? $getProduct->product_description : '';
		$json['product_image'] = !empty($getProduct->product_image) ? $getProduct->product_image : '';
		$json['product_rate'] = $getProduct->product_rate;
		$json['product_like'] = !empty($getProduct->product_like) ? $getProduct->product_like : '';
		$json['product_offer'] = !empty($getProduct->product_offer) ? $getProduct->product_offer : '';
		$json['offer_available'] = $getProduct->offer_available;
		$json['product_active']  = $getProduct->product_active;
		$json['product_type']    = !empty($getProduct->product_type) ? $getProduct->product_type : '';
		$json['product_category'] = !empty($getProduct->product_category) ? $getProduct->product_category : '';
		$json['product_tax'] = !empty($getProduct->product_tax) ? $getProduct->product_tax : '';
		$json['product_views'] = !empty($getProduct->product_views) ? $getProduct->product_views : '';
		return $json;
	}

	

}