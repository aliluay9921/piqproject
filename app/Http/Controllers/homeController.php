<?php

namespace App\Http\Controllers;
use App\triat\messagetriat;
use Illuminate\Http\Request;
use App\models\province;
use App\models\Post;
use App\models\skills;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
{
    use messagetriat;
    public function index(){

        $allpost=Post::select('id','Full_name','province_id')->where('approve',1)->with('province')->with('skills')->get();
        return $this->sendResponse($allpost,'get all post' );
    }

    public function show($id){

        $show=Post::select('id','Full_name','age','phone','province_id')->where('id' , $id)->with('province')->with('skills')->get();   
        $show->makehidden('province_id');    
        if($show->count() == 0)
        {
            return $this->senderror('0',' not found');
        }
        else
         return $this->sendResponse($show,'get  post' );
    }

    public function provinces(){

        $getprovince=province::all();
        return $this->sendResponse($getprovince,'all province to add combo' );
    }

    public function userprovince($id){
        if($id == 0){
            $get=Post::all();           
            return $this->sendResponse($get,'all post to all province' );
        }
        $province=province::find($id);
        if(!$province)
        {
            return $this->senderror('0','province not found');
        }
        $get=$province->post->where('approve',1);
        
        if($get->count() == 0)
        {
            return $this->senderror('0',' no post found ');

        }
        return $this->sendResponse($get,'all post in province' );
    }


    public function skills(){

        $getskills=skills::all();
        return $this->sendResponse($getskills,'all province' );
    }

    public function userskills($id){

        $userskills=skills::find($id);
        if(!$userskills)
        {
            return $this->senderror('0','skill not found');
        }
        $get=$userskills->post;
        return $this->sendResponse($get,'all province' );
    }

    public function addpost(Request $request){

        $validation=validator::make($request->all(),[
            'Full_name'=> 'requierd',
            'phone'    =>'requierd|integer',
            'age'      =>'requierd|integer',    
            'province_id'      =>'requierd',    
            'skills_id'      =>'requierd',       
   
        ]);
        $add=Post::create(
            'Full_name'=>$request->full_name,
            'phone'    =>$request->phone,
            'age'      =>$request->age,
            'province_id'=>$request->province_id,
        );
        $skills=skills::create();

    }
}
