<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $form_data = $request->all();

        $validator = Validator::make($form_data,
            [
                'name' => 'required',
                'email' => 'required|email',
                'content' => 'required'
            ]
            );

            if($validator->fails()){
                return response()->json(
                    [
                        'success' => false,
                        'errors' => $validator->errors()
                    ]

                );
            }

        $newLead = new Lead();
        $newLead->fill($form_data);
        $newLead->save();

        Mail::to('manusacco92@gmail.com')->send(new NewContact($newLead));

        return response()->json(
            [
                'success' => true
            ]
        );

    }
}
