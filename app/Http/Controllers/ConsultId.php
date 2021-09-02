<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ConsultId extends Controller
{
    public function index()
    {
        return view('users.ConsultId');

    }

    public function consuluser(Request $request)
    {
        $id = $request->input('ownerId');

        //dd($id);

        if (User::where('id', $id)->first()) {
            
            return view('auth.register');

        }

            return redirect('consulta')->with([
                'message' => 'Referido incorrecto, por favor verifique el id de referido!'
        ]);      
        
    }

}
