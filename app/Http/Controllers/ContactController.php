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

        if(Contact::where('email', $dadosContact['email'])->where('user_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('error','Já existe um contato com o email: '.$dadosContact['email'].' cadastrado');
        }else if(Contact::where('contact', $dadosContact['contact'])->where('user_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('error','Já existe um contato com o numero: '.$dadosContact['email'].' cadastrado');
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

    public function showEditContact(String $id){
        $contact = Contact::find($id);
        return view('contactEdit', ['contact'=>$contact]);
    }

    public function storeEditContact(Request $request, String $id){
        $dadosEdit = $request->except('_token','_method');

        if(Contact::where('email', $dadosEdit['email'])->where('user_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('error','There is already a contact with this email registered');
        }else if(Contact::where('contact', $dadosEdit['contact'])->where('user_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('error','There is already a contact with this number contact registered');
        }

        $contact = Contact::findOrFail($id);
        $contact->update($dadosEdit);

        return redirect()->route('contact.edit', ['id'=>$id])->with('success','Contact update success');
    }
}
