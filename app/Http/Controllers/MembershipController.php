<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        

    }

    public function create()
    {
        

    }

    public function perfomrValidationCreate(Request $request)
    {
        $rules = [
        

      ];

        $messages =[

          

        ];

    $this->validate($request, $rules, $messages);

    }

    public function store(Request $request)
    {
        

        //$this->perfomrValidationCreate($request);
        

    }

    public function indexuser()
    {

        

    }


}
