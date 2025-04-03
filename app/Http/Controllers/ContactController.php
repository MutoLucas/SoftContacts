<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    public function contactCreation(){
        return view('contactCreation');
    }

    public function storeContact(Request $request){
        $dadosContact = $request->except('_token');

        if(Contact::where('email', $dadosContact['email'])->exists()){
            return redirect()->back()->with('error','Já existe um contato com o email: '.$dadosContact['email'].' cadastrado');
        }else{
            Contact::create([
                'user_id'=>auth()->user()->id,
                'name'=>$dadosContact['name'],
                'email'=>$dadosContact['email'],
                'contact'=>$dadosContact['contact']
            ]);

            return redirect()->back()->with('success','Contato para o email: '.$dadosContact['email'].' cadastrado com sucesso');
        }
    }
}
