<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    //
    public function index(){
        $avaialableProviders = ["DataProviderX" , "DataProviderY"];
        $provider = $_GET["provider"];
        $statusCode = (int)$_GET["statusCode"];
        $balanceMin = (int)$_GET["balanceMin"];
        $balanceMax = (int)$_GET["balanceMax"];
    

        $path_DataProviderX = '../jsons/DataProviderX.json';
        $path_DataProviderY = '../jsons/DataProviderY.json';
        $content_DataProviderX = json_decode(file_get_contents($path_DataProviderX), true);
        $content_DataProviderY = json_decode(file_get_contents($path_DataProviderY), true);
        $content_2_DataProviderX = array_values($content_DataProviderX);
        $content_2_DataProviderY = array_values($content_DataProviderY);
        if($provider=="DataProviderX"){
            $merged_content = $content_2_DataProviderX;
        }
        else if($provider=="DataProviderY"){
            $merged_content = $content_2_DataProviderY;
        }
        else{
            $merged_content = array_merge($content_2_DataProviderX, $content_2_DataProviderY);
        }

        // dd($content_DataProviderX);
        // dd($merged_content);
        $deleted_elements=[];
        for($i=0;$i<count($merged_content);$i++){
            $statusCodeVal = (int)array_values($merged_content[$i])[3];
            $balance = (int)array_values($merged_content[$i])[0];
            // dd($statusCodeVal);
            
            if((($statusCodeVal != $statusCode) && ($statusCodeVal != ($statusCode *100)) && ($statusCode!= 0))||(($balance < $balanceMin) || ($balance > $balanceMax))){
                // unset($merged_content[$i]);
                array_push($deleted_elements,$i);
            }
            
        }

        // for($i=0;$i<count($merged_content);$i++){
            
        //     // dd($statusCodeVal);
            
        //     if(){
        //         // unset($merged_content[$i]);
        //         array_push($deleted_elements,$i);
        //     }
            
        // }

        // dd($deleted_elements);

        foreach($deleted_elements as $deleted_element){
            unset($merged_content[$deleted_element]);
        }
            
            
        
        // dd($merged_content);
        // dd($merged_content);

        // $merged_content = array_merge($content_2_DataProviderX, $content_2_DataProviderY);
        // dd($merged_content);
        
        // $headers_DataProviderX =array_keys($content_2_DataProviderX[0]);
        // $headers_DataProviderY =array_keys($content_2_DataProviderY[0]);
        $headers = array_keys($content_2_DataProviderY[0]);
        // $headers =array_keys($content["1"]);
        //dd($headers);
        // dd($avaialableProviders);
        return view('api.v1.users.index',compact('headers','merged_content','avaialableProviders'));
    }
}
