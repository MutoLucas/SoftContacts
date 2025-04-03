<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class IndexController extends Controller
{
    public function showIndex(Request $request){
        if(auth()->user()->role == 'admin'){
            $query = Contact::query();
        }else{
            $query = Contact::query()->where('user_id', auth()->id());
        }


        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('contact')) {
            $query->where('contact', 'like', '%' . $request->input('contact') . '%');
        }

        $contacts = $query->paginate(5);

        return view('index', ['contacts' => $contacts]);
    }
}
