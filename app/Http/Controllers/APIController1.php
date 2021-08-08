<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\VersionSettingModel;
use App\WestwayFoodMenuModel;
use App\WestwayFoodBestSellerModel;

class APIController extends Controller {

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
		$otp = rand(1111,9999);
		$record = User::where('mobile','=',$request->mobile)->first();
		
			if(empty($record)) {
				$record = new User;
			}
			$record->mobile            = trim($request->mobile);
			$record->token             = !empty($request->token)?$request->token:null;
			// $record->otp            = 9999;
			$record->otp               = $otp;
			$record->save();
			$this->updateToken($record->id);

			$json['status'] = 1;
			$json['message'] = 'Account successfully created';

            $json['result'] = $this->getProfileUser($record->id);
	
	    echo json_encode($json);
	}

	public function app_verify_otp(Request $request)
	{
		if (!empty($request->mobile) && !empty($request->otp)) {
			$user = User::where('mobile', '=', $request->mobile)->where('otp', '=', $request->otp)->first();
		if(!empty($user)){
			$check = $user->otp;
				if(!empty($check)){
				    $user->otp_verify = 1;
					$user->save();
					$this->updateToken($user->id);
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
				$json['message'] = 'Mobile and otp wrong.';
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
			   $user = User::where('mobile', '=', trim($request->mobile))->first();
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

	public function getProfileUser($id)
	{
		$user 						= User::find($id);
		$json['user_id'] 			= $user->id;
		$json['name'] 				= !empty($user->name) ? $user->name : '';
		$json['lastname'] 			= !empty($user->lastname) ? $user->lastname : '';
		$json['mobile'] 			= !empty($user->mobile) ? $user->mobile : '';
		$json['otp'] 		    	= !empty($user->otp) ? $user->otp : '';
		$json['social_type'] 		= !empty($user->social_type) ? $user->social_type : '';
		$json['social_id'] 		    = !empty($user->social_id) ? $user->social_id : '';
		$json['user_profile']       = !empty($user->user_profile) ? $user->user_profile : '';
		$json['address']			= !empty($user->address) ? $user->address : '';
		$json['city']				= !empty($user->city) ? $user->city : '';
		$json['state'] 				= !empty($user->state) ? $user->state : '';
		$json['country'] 			= !empty($user->country) ? $user->country : '';
		$json['postcode'] 			= !empty($user->postcode) ? $user->postcode : '';
		return $json;
	}

	public function app_update_profile(Request $request){
		if (!empty($request->name)){
		$uprecord = User::find($request->id);
		if(!empty($uprecord)){
			$uprecord->name      = trim($request->name);
			$uprecord->lastname  = trim($request->lastname);
			$uprecord->address   = trim($request->address);
			$uprecord->city 	 = trim($request->city);
			$uprecord->state     = trim($request->state);
			$uprecord->country   = trim($request->country);

			if (!empty($request->file('user_profile'))) {
				if (!empty($uprecord->user_profile) && file_exists('upload/profile/' . '/' . $uprecord->user_profile)) {
					unlink('upload/profile/' . $uprecord->user_profile);
				}
				$ext = 'jpg';
				$file = $request->file('user_profile');
				$randomStr = str_random(30);
				$filename = strtolower($randomStr) . '.' . $ext;
				$file->move('upload/profile/', $filename);
				$uprecord->user_profile = $filename;
			}
			else
			{
				$uprecord->user_profile = '';
			}

			$uprecord->postcode  = trim($request->postcode);	
			$uprecord->save();

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

}