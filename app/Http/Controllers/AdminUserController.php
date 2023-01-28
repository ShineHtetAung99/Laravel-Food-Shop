<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    // direct userlist
    public function userList(){
        $users = User::where('role','user')
                ->when(request('key'),function($query){
                    $query->where('users.name','like','%'.request('key').'%')
                          ->orWhere('users.email','like','%'.request('key').'%')
                          ->orWhere('users.phone','like','%'.request('key').'%')
                          ->orWhere('users.gender','like','%'.request('key').'%');
                })
                ->paginate(4);
        return view('admin.user.list',compact('users'));
    }

    // change user role
    public function userChangeRole(Request $request){
        $updateSource = ['role' => $request->role];
        User::where('id',$request->userId)->update($updateSource);
    }

    // edit user profile
    public function edit($id){
        $user = User::where('id',$id)->first();
        return view('admin.user.edit',compact('user'));
    }

    // update user profile
    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if($request->hasFile('image')){
            // 1 old image name | check => delete | store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'User Profile Updated Successfully!']);
    }

    // delete user account
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted Successfully!']);
    }

    // request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }
}
