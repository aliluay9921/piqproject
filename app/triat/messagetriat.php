<?php 

namespace App\triat;

Trait messagetriat{

    public function sendresponse($result,$message){

        return response()->json([
            
            'status'=>true,
            'data'=>$result,
            'message'=>$message,
        ],200);         
    }

    public function senderror($error='null',$msg){
        
       
        return response()->json([
            'status'=>false,
            'data'=>$error,
            'msg'=>$msg
            ]
        );
    }





}


?>