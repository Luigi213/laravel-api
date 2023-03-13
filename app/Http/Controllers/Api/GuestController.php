<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\Guest;
use App\Mail\GuestLead;

class GuestController extends Controller
{
    public function store(Request $request){
       $form_data = $request->all();

       $validation = Validator::make($form_data, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'number' => 'required',
            'message' => 'required'
       ]);

        if($validation->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        
        $newContact = new Guest();
        $newContact->fill($form_data);

        $newContact->save();

        Mail::to('info@boolpress.com')->send(new GuestLead($newContact));

        return response()->json([
            'success' => true,
        ]);
    }
}
