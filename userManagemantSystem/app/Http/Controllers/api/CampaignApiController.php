<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\campaign;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CampaignApiController extends Controller
{
    public function createCampaign(Request $request) {
        $validator = Validator::make($request->all() ,[
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if($validator->fails()) {
            return $this->sendFailResponse('The given data is invalid', $validator->errors());
        }
        
        try {       
            $imageName = '';
            $imgPath = '';
            if ($request->img) {
                $imageName = time() . '.' . $request->img->extension();
                $request->img->move(public_path('uploads'), $imageName);
                $imgPath = asset('uploads/'.$imageName);
            }

            $title = campaign::where("title", "=", $request->title)->where("user_id", "=",Auth::user()->id)->first();

            $data = new campaign;
            if($title) {
                return $this->sendFailResponse('The given data is invalid', ['title'=>'Campaign name has been already taken, Try with another one']);
            }
            else {
                $data->title = $request->title;
            }
            $data->Description = $request->description;
            $data->img = $imageName;
            $data->user_id = Auth::user()->id;
            do {
                $data->unique_id = random_int(100000, 999999);
            } while (campaign::where("unique_id", "=", $data->unique_id)->first());
            $data->save();

            $campaign = [  
                "id"=> $data->id,
                "title"=> $data->id,
                "img"=> $imgPath,
                "Description"=> $data->Description,
                "unique_id"=> $data->unique_id,
                "user_id"=> $data->user_id];
        }
        catch(\Exception $exception) {
            Log::error($exception);
            return $this->sendFailResponse($exception);
        }
  
        return $this->sendSuccessResponse('Campaign created successfully', $campaign);
    }


    public function editCampaign(Request $request, $id) 
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        try {

            $campaign_id = campaign::where('id', $request->id)->first()->user_id;

            if(Auth::user()->id == $campaign_id)
            {
                $campaign = campaign::find($id);
            
                $imageName = '';
                $imgPath = '';
                if ($request->img) {    
                    $imageName = time() . '.' . $request->img->extension();
                    $request->img->move(public_path('uploads'), $imageName);
                    $imgPath = asset('uploads/'.$imageName);
                    $campaign->img = $imageName;   
                }


                if($campaign->title == $request->title) {
                    $campaign->title = $request->title;
                }
                else{
                    $title = campaign::where("title", "=", $request->title)->where("user_id", "=",Auth::user()->id)->first();

                    if($title) {
                        return $this->sendFailResponse(['title'=>'Campaign name has been already taken, Try with another one.']);
                    }
                    else{
                        $campaign->title = $request->title;
                    }
                }

                $campaign->Description = $request->description;
                $campaign->update();

                $data = [  
                    "id"=> $campaign->id ,
                    "title"=> $campaign->id,
                    "img"=> $imgPath,
                    "Description"=> $campaign->Description,
                    "unique_id"=> $campaign->unique_id,
                    "user_id"=> $campaign->user_id
                ];
            }
            else {
                return $this->sendFailResponse('You have no authorization to edit this campaign.');
            }
        }

        catch(\Exception $exception) {
            log::error($exception);
            return $this->sendFailResponse($exception);
        }

        return $this->sendSuccessResponse('Campaign has been updated successfully.', $data);
    }
}


