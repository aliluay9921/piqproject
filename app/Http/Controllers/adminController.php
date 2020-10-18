<?php

namespace App\Http\Controllers;
use App\triat\messagetriat;

use App\models\Post;
use App\models\skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class adminController extends Controller
{

    use messagetriat;


    public function getpost(){
        $getpost=Post::where('approve','false')->orderBy('id','desc')->paginate(15);
        if(!$getpost)
        {
            return $this->senderror('0',' not request');
        }
        return $this->sendResponse($getpost,'get all post not approve' );
    }

    public function approve(Request $request){
        $getpostid=Post::find($request->id);
        if(!$getpostid){
            return $this->senderror('0',' not post');
        }
        $getpostid->Update([
            'approve' => 'true'
        ]);
        return $this->sendResponse($getpostid,'approve successfully' );
    }


    public function addskills(Request $request){
        $validation=validator::make($request->all(),[
            'title'    => 'required',
            'image'    =>'required|image',
        ]);

        if($validation->fails()){
            return $this->senderror('0','validate is none success');
        }
        $req=$request->image;
        $file_extension=$req->getClientOriginalName();
        $file_name=time().'.'.$file_extension;
        $path='picture';
       $req->move($path,$file_name);

       $store= skills::create([
            'image'=>$file_name,                      
            'title'=>$request->title,
        ]);
        return $this->sendResponse($store,'approve successfully' );


    }
}
