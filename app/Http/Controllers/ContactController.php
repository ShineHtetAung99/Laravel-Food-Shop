<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // contact list
    public function contactList(){
        $contact = Contact::select('contacts.*','users.id as user_id')
                    ->when(request('key'),function($query){
                        $query->where('contacts.name','like','%'.request('key').'%')
                              ->orWhere('users.id','like','%'.request('key').'%')
                              ->orWhere('contacts.email','like','%'.request('key').'%');
                    })
                    ->leftJoin('users','users.email','contacts.email')
                    ->orderBy('created_at','desc')
                    ->paginate(7);
        $contact->appends(request()->all());
        return view('admin.contact.list',compact('contact'));
    }

    // delete contact
    public function delete($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#contactList')->with(['deleteSuccess'=>'Contact Message Deleted Successfully!']);
    }

    // view contact
    public function view($id){
        $contact = Contact::where('id',$id)->first();
        return view('admin.contact.view',compact('contact'));
    }
}
