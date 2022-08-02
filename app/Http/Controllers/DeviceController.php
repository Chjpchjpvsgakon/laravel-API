<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;
class DeviceController extends Controller
{
    function list()
    {
        return Device::all();
    }

    //Chỉ cần viêt 1 func list them param là ok, func này dành cho tét demo
    function listbyid($id=null){
        //thêm giá trị mặc định cho id vs check nếu id isset return value nếu k trả ra all
        return $id?Device::find($id):Device::all();
    }

    function addDevice(Request $req)
    {
        $device = new Device;
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result = $device->save();
        
        if($result){
            return ['Result'=>'Data has been saved'];
        }else{
            return ['Result'=>'Operation failed'];
        }
    }


    function updateDevice(Request $req)
    {
        $device = Device::find($req->id);
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result = $device->save();

        if($result){
            return ["Result"=>"Data is Updated"];
        }else{
            return ["Result"=>"Update Data Operation failed"];
        }
        
    }

    //Search API
    function search($name)
    {
        return Device::where("name", "like","%". $name ."%")->get();
    }

    //Delete
    function delete($id){
        $device = Device::find($id);
        $res = $device->delete();
        if($res){
            return ["Result"=>"Device has been deleted"];
        }else{
            return ["Result"=>" Delete Failed"];
        }
        
    }

    //Validate
    function testvalidate(Request $req)
    {
        $rules = array(
            'member_id'=>'required|min:2|max:4'
        );
        $validate = Validator::make($req->all(), $rules);
        if($validate->fails())
        {
            //return $validate->errors();  

            //return with status code when error
            return response()->json($validate->errors(), 403);
        }else{
            $device= new Device;
            $device->name=$req->name;
            $device->member_id=$req->member_id;
            $result = $device->save();

            if($result){
                return ["Result"=>"Data is Updated"];
            }else{
                return ["Result"=>"Update Data Operation failed"];
            }
        }
        
    }

}
