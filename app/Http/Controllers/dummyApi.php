<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyApi extends Controller
{
    function getData(){
        return ["name"=>"Halo","email"=>"halo.drg@gmail.com", "address"=>'HaNoi'];
    }
}
