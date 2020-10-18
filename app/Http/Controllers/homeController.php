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

        $allpost=Post::select('id','Full_name','province_id')->where('approve','true')->with('province')->with('skills')->orderBy('id','ASC')->paginate(10);
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
         return $this->sendResponse($show,'show only post' );
    }

    public function provinces(){

        $getprovince=province::all();
        return $this->sendResponse($getprovince,'all province' );
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
        $get=$province->post->where('approve','true');
        
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
        $get=$userskills->post->where('approve','true');
        return $this->sendResponse($get,'all province' );
    }

    public function addpost(Request $request){

        $validation=validator::make($request->all(),[
            'Full_name'         => 'required',
            'Phone'             =>'required',
            'age'               =>'required|integer',    
            'province_id'       =>'required',    
            'skills_id'         =>'required',       
   
        ]);

        if($validation->fails()){
            return $this->senderror('0','validate is none success');
        }
       
            $addpost= new Post;
            $addpost->Full_name=$request->Full_name;
            $addpost->age=$request->age;
            $addpost->Phone=$request->Phone;
            $addpost->province_id=$request->province_id;
            $addpost->save();
            $addpost->skills()->syncWithoutDetaching($request->skills_id);

            return $this->sendResponse($addpost,'all province' );

    }
}
