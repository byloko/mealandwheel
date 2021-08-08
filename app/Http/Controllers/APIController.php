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

class APIController extends Controller {

	use CommonAPIController;

	public $token;

	public function __construct(Request $request) {
		
		$this->token = !empty($request->header('token'))?$request->header('token'):'';
	}

	public function updateToken($user_id)
	{
		$randomStr = str_random(40).$user_id;
		$save_token = User::find($user_id);
		$save_token->user_token = $randomStr;
		$save_token->save();
	}
	

	public function app_register_login(Request $request)
	{
		if (!empty($request->mobile)) {
		$record = User::where('mobile','=',$request->mobile)->first();
			if(empty($record)) {
				$record = new User;
			}
			$record->mobile            = trim($request->mobile);
			$record->token             = !empty($request->token)?$request->token:null;
		
			$record->save();
			$this->updateToken($record->id);

			$json['status'] = 1;
			$json['message'] = 'Account successfully created';

            $json['result'] = $this->getProfileUser($record->id);
		}else{
			$json['status'] = 0;
			$json['message'] = 'Premier missing!';
		}

	    echo json_encode($json);

	
	}

	public function app_store_mobile_otp(Request $request){
		if (!empty($request->otp) && !empty($request->user_id)) {
		$update_record = User::find($request->user_id);
			if(!empty($update_record)){
		    $update_record->otp = trim($request->otp);
		    $update_record->otp_verify = 1;
			$update_record->save();

			$json['status'] = 1;
			$json['message'] = 'Mobile OTP updated successfully.';

			$json['user_data'] = $this->getProfileUser($update_record->id);
		}else{
			$json['status'] = 0;
			$json['message'] = 'Invalid User.';
		}
		} 
		else 
		{

			$json['status'] = 0;
			$json['message'] = 'Parameter missing!';
		}

		echo json_encode($json);
	}

	public function app_verify_otp(Request $request)
	{
		if (!empty($request->mobile) && !empty($request->otp) && !empty($request->user_type)) {
			$user = User::where('mobile', '=', $request->mobile)->where('otp', '=', $request->otp)->where('user_type', '=', $request->user_type)->first();
		if(!empty($user)){
			$check = $user->otp;
				if(!empty($check)){
				    $user->otp_verify = 1;
					$user->save();
					// $this->updateToken($user->id);
					$json['status'] = 1;
					$json['message'] = 'Verified Successfully.';
					$json['result'] = $this->getProfileUser($user->id);
				}
				else 
				{
					$json['status'] = 0;
					$json['message'] = 'Invalid OTP entred.';
				}
			}else{
				
				$json['status'] = 0;
				$json['message'] = 'OTP Wrong.';
			}
		}
		else {
			$json['status'] = 0;
			$json['message'] = 'Parameter missing!';
		}

		echo json_encode($json);
	}


	public function app_resend_otp(Request $request)
	{
		if(!empty($request->mobile)){
			$otp = rand(1111,9999);
			   $user = User::where('mobile', '=', trim($request->mobile))->where('user_type', '=', trim($request->user_type))->first();
			if (!empty($user)) {
				//$user->otp = 9998;
				$user->otp = $otp;
				$user->save();
				$this->updateToken($user->id);

			$json['status'] = 1;
			$json['message'] = 'OTP sent successfully.';
			$json['result'] = $this->getProfileUser($user->id);

		}
		 else {
				$json['status'] = 0;
				$json['message'] = 'Mobile number not found!';
			}
		} else {
			$json['status'] = 0;
			$json['message'] = 'Record not found.';
		}
		echo json_encode($json);
	}

	public function app_social_login(Request $request)
	{

		if(!empty($request->social_id)){
		$checksocialid = User::where('social_id', '=', trim($request->social_id))->count();
			if($checksocialid == '0'){
			$record = new User;
			$record->email 				= trim($request->email);

			if (!empty($request->file('user_profile'))) {
				if (!empty($record->user_profile) && file_exists('upload/profile/' . '/' . $record->user_profile)) {
					unlink('upload/profile/' . $record->user_profile);
				}
				$ext = 'jpg';
				$file = $request->file('user_profile');
				$randomStr = str_random(30);
				$filename = strtolower($randomStr) . '.' . $ext;
				$file->move('upload/profile/', $filename);
				$record->user_profile = $filename;
			}
			else
			{
				$record->user_profile = '';
			}
			$record->mobile         = trim($request->mobile);
				
			$record->social_type    = trim($request->social_type);
			$record->social_id      = trim($request->social_id);
			$record->token          = !empty($request->token)?$request->token:null;
			$record->save();
			  $this->updateToken($record->id);
			$json['status'] = 1;
			$json['message'] = 'Account Successfully created.';
			$json['result'] = $this->getProfileUser($record->id);
			}
			else {
				$json['status'] = 0;
				$json['message'] = 'Your social id already exist please login or try again.';
			}
		}
		else {
			$json['status'] = 0;
			$json['message'] = 'Parameter missing!';
		}
		echo json_encode($json);
	}	

	

	public function app_create_your_profile(Request $request){

		if (!empty($request->name)){
		$uprecord = User::find($request->user_id);
		if(!empty($uprecord)){
			$uprecord->name      = trim($request->name);
			$uprecord->lastname  = trim($request->lastname);
			$uprecord->address   = trim($request->address);
			$uprecord->email     = trim($request->email);

			if (!empty($request->file('identity_proof'))) {
				if (!empty($uprecord->identity_proof) && file_exists('upload/profile/' . '/' . $uprecord->identity_proof)) {
					unlink('upload/profile/' . $uprecord->identity_proof);
				}
				$ext = 'jpg';
				$file = $request->file('identity_proof');
				$randomStr = str_random(30);
				$filename = strtolower($randomStr) . '.' . $ext;
				$file->move('upload/profile/', $filename);
				$uprecord->identity_proof = $filename;
			}
			else
			{
				$uprecord->identity_proof = '';
			}

			$uprecord->save();

			if(!empty($request->slider_pic)) {   
	            foreach ($request->slider_pic as $value) {

	                if(!empty($value)) {
	                   
	                    $option = new UserSliderModel;    
	                    $option->user_id = $uprecord->id;
	                        $ext = 'jpg';
	                        $file = $value;
	                        $randomStr = str_random(30);
	                        $filename = strtolower($randomStr) . '.' . $ext;
	                        $file->move('upload/profile/', $filename);
	                        $option->slider_pic = $filename;
	                 
	                    $option->save();  

	                }
	            }
	        }

			    $json['status'] = 1;
		  	 	$json['message'] = 'Profile updated successfully.';
		  	 	$json['result'] = $this->getProfileUser($uprecord->id);
			}else{
				$json['status'] = 0;
				$json['message'] = 'Invalid User.';
			}
		 }
		else 
	    {
			$json['status'] = 0;
			$json['message'] = 'Parameter missing!';
	    }

		echo json_encode($json);
	}

	public function app_westway_food_menu_list(Request $request)
	{
		$result = array();
		// if(!empty($request->id))
		// {
		$getRecord = WestwayFoodMenuModel::get();
		foreach ($getRecord as $value) {
			$data['id'] 			        = $value->id;
			$data['westway_food_menu_name'] = !empty($value->westway_food_menu_name) ? $value->westway_food_menu_name : '';
			$result[] = $data;
		}
		$json['status'] = 1;
		$json['message'] = 'All westway food menu loaded successfully.';
		$json['result'] = $result;
		// }
		// else
		// {	
		// 	$json['status'] = 0;
		// 	$json['message'] = 'Record not found.';
		// }


		echo json_encode($json);
	}

	public function app_best_sellers_list(Request $request){
		$result = array();
		// if(!empty($request->id))
		// {
		$getRecord = WestwayFoodBestSellerModel::get();
		foreach ($getRecord as $value) {
			$data['id'] 		   = $value->id;
			$data['food_image']    = !empty($value->food_image) ? $value->food_image : '';
			$data['food_name']     = !empty($value->food_name) ? $value->food_name : '';
			$data['category_name'] = !empty($value->category_name) ? $value->category_name : '';
			$data['price']         = !empty($value->price) ? $value->price : '';
			$result[] = $data;
		}
		$json['status'] = 1;
		$json['message'] = 'All westway food best sellers loaded successfully.';
		$json['result'] = $result;
		// }
		// else
		// {	
		// 	$json['status'] = 0;
		// 	$json['message'] = 'Record not found.';
		// }


		echo json_encode($json);
	}

	public function app_version_setting_update(Request $request){
		
		$record = VersionSettingModel::find(1);
		if(!empty($record)){
			$record->app_version   = trim($request->app_version);
			$record->save();
			$json['status'] = 1;
			$json['message'] = 'Update App.';
			$json['user_data'] = $this->getVersionSetting($record->id);
		}else{
			$json['status'] = 0;
			$json['message'] = 'Record not found.';
		}
		echo json_encode($json);
	}

	public function getVersionSetting($id){
		$result   					= VersionSettingModel::find($id);
		//$json['id']				= $result->id;	
		$json['user_id']			= $result->id;	
		$json['app_version']        = !empty($result->app_version) ? $result->app_version : '';
	   	return $json;
	}

	public function app_vendor_update_profile(Request $request){
		if (!empty($request->name)){

		$up_record = User::find($request->user_id);
			if(!empty($up_record)){
				$up_record->name      = trim($request->name);
				$up_record->cart_name      = trim($request->cart_name);

				if (!empty($request->file('identity_proof'))) {
					if (!empty($up_record->identity_proof) && file_exists('upload/profile/' . '/' . $up_record->identity_proof)) {
						unlink('upload/profile/' . $up_record->identity_proof);
					}
					$ext = 'jpg';
					$file = $request->file('identity_proof');
					$randomStr = str_random(30);
					$filename = strtolower($randomStr) . '.' . $ext;
					$file->move('upload/profile/', $filename);
					$up_record->identity_proof = $filename;
				}
				else
				{
					$up_record->identity_proof = '';
				}

				
				$up_record->address        = trim($request->address);
				$up_record->email          = trim($request->email);

				$up_record->save();

			// dd($request->slider_pic);
				if(!empty($request->slider_pic)) {   
		            foreach ($request->slider_pic as $value) {

		                if(!empty($value)) {
		                   
		                    $option = new UserSliderModel;    
		                    $option->user_id = $up_record->id;
		                        $ext = 'jpg';
		                        $file = $value;
		                        $randomStr = str_random(30);
		                        $filename = strtolower($randomStr) . '.' . $ext;
		                        $file->move('upload/profile/', $filename);
		                        $option->slider_pic = $filename;
		                 
		                    $option->save();  

		                }
		            }
		        }

			    $json['status'] = 1;
		  	 	$json['message'] = 'Profile updated successfully.';
		  	 	$json['result'] = $this->getProfileUser($up_record->id);
			}else{
				$json['status'] = 0;
				$json['message'] = 'Invalid User.';
			}

		}
		else 
	    {
			$json['status'] = 0;
			$json['message'] = 'Parameter missing!';
	    }

		echo json_encode($json);
	}

// POSTMAN =>  

	public function app_bank_detail(Request $request){
		if (!empty($request->account_number) && !empty($request->user_id)) {
		$update_record = User::find($request->user_id);
		
		if(!empty($update_record)){
		    
		    $update_record->account_number = trim($request->account_number);
		    $update_record->bank_name = trim($request->bank_name);
		    $update_record->ifsc_code = trim($request->ifsc_code);
		    $update_record->account_holder_name = trim($request->account_holder_name);
		    $update_record->branch_name = trim($request->branch_name);
		   
			$update_record->save();

			$json['status'] = 1;
			$json['message'] = 'Bank detail updated successfully.';

			$json['user_data'] = $this->getProfileUser($update_record->id);
		}else{
			$json['status'] = 0;
			$json['message'] = 'Invalid User.';
		}
		} 
		else 
		{
			$json['status'] = 0;
			$json['message'] = 'Parameter missing!';
		}

		echo json_encode($json);
	}
	
	public function app_order_list(Request $request){
		
		$getresultCount = User::where('id', '=', $request->user_id)->count();
		if(!empty($getresultCount)){

		$result = array();
		$update_record = OrderModel::where('user_id', '=', $request->user_id)->where('order_status', '=', $request->order_status)->get();
		
		foreach ($update_record as $value) {
			$data['id']				   = $value->id;
			$data['user_id']		   = $value->user_id;
			$data['name']              = !empty($value->getUserName->name) ? $value->getUserName->name : '';
			$data['address']              = !empty($value->getUserName->address) ? $value->getUserName->address : '';
			$data['mobile']              = !empty($value->getUserName->mobile) ? $value->getUserName->mobile : '';
			$data['user_profile']              = !empty($value->getUserName->user_profile) ? $value->getUserName->user_profile : '';
			$data['email']              = !empty($value->getUserName->email) ? $value->getUserName->email : '';
			$data['order_name']        = !empty($value->order_name) ? $value->order_name : '';
			$data['order_status']      = !empty($value->order_status) ? $value->order_status : '';
			$data['order_date']        = !empty($value->order_date) ? $value->order_date : '';
			$data['order_amount']      = !empty($value->order_amount) ? $value->order_amount : '';
			
			$data['product_id']        = !empty($value->product_id) ? $value->product_id : '';

			$data['product_name']        = !empty($value->getProductName->product_name) ? $value->getProductName->product_name : '';
			$data['product_description']        = !empty($value->getProductName->product_description) ? $value->getProductName->product_description : '';
			$data['product_image']        = !empty($value->getProductName->product_image) ? $value->getProductName->product_image : '';
			$data['product_rate']        = $value->getProductName->product_rate;
			$data['product_like']        = !empty($value->getProductName->product_like) ? $value->getProductName->product_like : '';
			$data['product_offer']        = !empty($value->getProductName->product_offer) ? $value->getProductName->product_offer : '';
			$data['offer_available']        = $value->getProductName->offer_available;
			$data['product_active']        = $value->getProductName->product_active;
			$data['product_type']        = !empty($value->getProductName->product_type) ? $value->getProductName->product_type : '';
			$data['product_category']        = !empty($value->getProductName->product_category) ? $value->getProductName->product_category : '';
			$data['product_tax']        = !empty($value->getProductName->product_tax) ? $value->getProductName->product_tax : '';
			$data['product_views']        = !empty($value->getProductName->product_views) ? $value->getProductName->product_views : '';

			$result[] = $data;
		}
		  
			$json['status'] = 1;
			$json['message'] = 'All data loaded successfully.';
	     	$json['result']  = $result;

		}
		else
		{	
			$json['status'] = 0;
			$json['message'] = 'Record not found.';
		}


		echo json_encode($json);
	}

	public function app_profile_list(Request $request){
		$getUserCount = User::where('id', '=', $request->user_id)->count();
		if(!empty($getUserCount)){
		$result = array();

		$getRecord = User::where('id', '=', $request->user_id)->get();
		  	foreach ($getRecord as $key => $value) {
			// $data['user_id']              = $value->id;
				$data = $this->getProfileUser($value->id);
				$result[] = $data;	

			}

		$json['status'] = 1;
		$json['message'] = 'All data loaded successfully.';
		$json['result'] = $result;
		
		}else{
			$json['status'] = 0;
			$json['message'] = 'Invalid User ID..';
		}
	   
	   echo json_encode($json);
	}	
// utorrent
	public function app_home_list(Request $request){

		$getUserCount = User::where('id', '=', $request->user_id)->count();
		if(!empty($getUserCount)){
		$getRecord = ProductModel::where('user_id', '=', $request->user_id)->get();

		$result = array();
			foreach ($getRecord as $value) {
				$data['id'] = $value->id;
				$data['product_name'] = !empty($value->product_name) ? $value->product_name : '';
				$data['product_description'] = !empty($value->product_description) ? $value->product_description : '';
				$data['product_image'] = !empty($value->product_image) ? $value->product_image : '';
				$data['product_rate']  = $value->product_rate;
				$data['product_like']  = !empty($value->product_like) ? $value->product_like : '';
				$data['product_offer'] = !empty($value->product_offer) ? $value->product_offer : '';
				$data['offer_available'] = $value->offer_available;
				$data['product_active']  = $value->product_active;
				$data['product_type']    = !empty($value->product_type) ? $value->product_type : '';
				$data['product_category'] = !empty($value->product_category) ? $value->product_category : '';
				$data['product_tax']   = !empty($value->product_tax) ? $value->product_tax : '';
				$data['product_views'] = !empty($value->product_views) ? $value->product_views : '';

				$result[]  = $data;
			}

			$json['status'] = 1;
			$json['message'] = 'All data loaded successfully.';
			$json['result'] = $result;
		}else{
			$json['status'] = 0;
			$json['message'] = 'Invalid User ID.';
		}
		echo json_encode($json);
	}

	public function app_order_status_update(Request $request){
	
		if(!empty($request->order_id) && !empty($request->order_status)){
			$UpdateRecord = OrderModel::find($request->order_id);
			if(!empty($UpdateRecord)){
				$UpdateRecord->order_status = trim($request->order_status);
				$UpdateRecord->save();

				$json['status'] = 1;
				$json['message'] = 'Record update successfully.';
			}else{
				$json['status'] = 0;
				$json['message'] = 'Invalid User ID.';
			}
		}else{
				$json['status'] = 0;
				$json['message'] = 'Premier missing.';
		}
		echo json_encode($json);
	}

	public function app_add_item(Request $request){
		if(!empty($request->user_id) && !empty($request->product_name)){

			$UserCount = User::where('id', '=', $request->user_id)->count();
			if(!empty($UserCount)){
			$InsertRecord = new ProductModel;
			$InsertRecord->user_id      = trim($request->user_id);
			$InsertRecord->product_name = trim($request->product_name);
			$InsertRecord->product_description = trim($request->product_description);
			
		 	if (!empty($request->file('product_image'))) {
	            $ext = 'jpg';
	            $file = $request->file('product_image');
	            $randomStr = str_random(30);
	            $filename = strtolower($randomStr) . '.' . $ext;
	            $file->move('upload/profile/', $filename);
	            $InsertRecord->product_image = $filename;
	        }

			$InsertRecord->product_rate  = trim($request->product_rate);
			$InsertRecord->save();

			$json['status'] = 1;
	        $json['message'] = 'Product successfully created.';
	        $json['result'] = $this->getProductList($InsertRecord->id);

	    }else{
	    	$json['status'] = 0;
	        $json['message'] = 'Invalid User ID.';
	    }
	    }else{
	    	$json['status'] = 0;
	        $json['message'] = 'Premier missing.';
	    }
	    echo json_encode($json);
	}

	public function app_min_and_max(Request $request){
		

	// min_price
	// max_price

        $getrecord = ProductModel::select('product.*');


        if(!empty($request->min_price) && !empty($request->max_price)) {
          $getrecord = $getrecord->where('product.product_rate','>=', $request->min_price);
        
          $getrecord = $getrecord->where('product.product_rate','<=', $request->max_price);
           
        }
        $getrecord = $getrecord->paginate(50);
   //      dd($getrecord);
       
       //  $getrecord = $getrecord->orderBy('product.id', 'desc');
       //  $getrecord = $getrecord->groupBy('product.id');
       //  
        	$result = array();
       foreach($getrecord as $value)
        	{
        		
        		$data['id'] 		 = $value->id;
        		$data['product_rate'] 		 = $value->product_rate;
        		$result[] = $data;
        	}
        	$json['status'] = true;
			$json['message'] = 'Record found.';
			$json['result'] = $result;

			 echo json_encode($json);
	}
}