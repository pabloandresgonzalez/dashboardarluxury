<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*
        
       $url = "https://blockchain.info/ticker";
       $data = json_decode(file_get_contents($url), true);


        print_r($data);

        //echo $data['USD'];

        //echo $data->USD."";

        //echo $data[1]->last;
        //echo $array[USD]->nombre_fruta;
        //echo $array[USD]->nombre_fruta;
        */

       /*
       $json = '[{"0":"1","id_fruta":"1","1":"Manzana","nombre_fruta":"Manzana","2":"100","cantidad":"100"},{"0":"2","id_fruta":"2","1":"Platano","nombre_fruta":"Platano","2":"167","cantidad":"167"},{"0":"3","id_fruta":"3","1":"Pera","nombre_fruta":"Pera","2":"820","cantidad":"820"}]';

       $array = json_decode($json);

       print_r($array);

       echo $array[0]->nombre_fruta*/

       //var_dump($data);

       return view('home');
        
    }

}
