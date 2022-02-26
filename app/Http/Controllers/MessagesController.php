<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\messages;

class MessagesController extends Controller
{
    //to submit comments
    public function submit(Request $request){

        $this->validate($request,[
            'type'=>'required',
            'name'=>'required',
            'email'=>'required',
        ]);
        
        $message = new messages;
        $message-> type = $request->input('type');
        $message-> name = $request->input('name');
        $message-> email = $request->input('email');
        $message-> message = $request->input('message');

        $message->save();

        return redirect('/')->with('success','Message Sent');
    }

    public function getMessages(){

        $messages = messages::all();

        return view('messages')->with('messages',$messages);
    }
}
