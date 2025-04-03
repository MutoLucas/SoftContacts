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
            return redirect()->back()->with('error','There is already an email contact: '.$dadosContact['email'].' registered');
        }else if(Contact::where('contact', $dadosContact['contact'])->where('user_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('error','There is already an contact number: '.$dadosContact['email'].' registred');
        }else{
            Contact::create([
                'user_id'=>auth()->user()->id,
                'name'=>$dadosContact['name'],
                'email'=>$dadosContact['email'],
                'contact'=>$dadosContact['contact']
            ]);

            return redirect()->back()->with('success','Email contact: '.$dadosContact['email'].' successfully registered');
        }
    }

    public function showEditContact(String $id){
        $contact = Contact::find($id);

        if(auth()->user()->id != $contact->user_id){
            return redirect()->route('index.index')->with('error','You do not have permission to edit this contact');
        }

        return view('contactEdit', ['contact'=>$contact]);
    }

    public function storeEditContact(Request $request, String $id){
        $dadosEdit = $request->except('_token','_method');
        $contact = Contact::findOrFail($id);

        if(Contact::where('email', $dadosEdit['email'])->where('user_id', auth()->user()->id)->where('id', '!=', $contact->id)->exists()){
            return redirect()->back()->with('error','There is already a contact with this email registered');
        }else if(Contact::where('contact', $dadosEdit['contact'])->where('user_id', auth()->user()->id)->where('id', '!=', $contact->id)->exists()){
            return redirect()->back()->with('error','There is already a contact with this number contact registered');
        }


        if(auth()->user()->id != $contact->user_id){
            return redirect()->route('index.index')->with('error','You do not have permission to edit this contact');
        }

        $contact->update($dadosEdit);

        return redirect()->route('contact.edit', ['id'=>$id])->with('success','Contact update success');
    }

    public function deleteContact(String $id){
        $contact = Contact::find($id);

        if(auth()->user()->id != $contact->user_id){
            return redirect()->route('index.index')->with('error','You do not have permission to delete this contact');
        }

        $contact->delete();
        return redirect()->route('index.index')->with('success','contact successfully deleted');
    }
}
