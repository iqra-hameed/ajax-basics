<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Api;
use DB;
use  App\Notifications\NewUserNotification;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RegisterInfoResource;
use App\Http\Controllers\Api\BaseController as BaseController;
class AuthController extends BaseController
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',

        ]);


        $data = new User();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=$request->password;

           $data = $request->all();
            $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

       // $register= User::create($data);

       $details['email'] = 'admin@gmail.com';
     dispatch(new SendEmailJob($details));
        // $user_role= Role::where(['name'=>'Customer'])->first();

        // if($user_role){
        //     $user->assignRole('customer');
        // }
         $admin=User::where('id',1)->first();
         $title = 'New User Created';
         $description = 'New User Created Successfully';
         $admin->notify(new NewUserNotification($title, $description));

        return new RegisterInfoResource($user,$admin);

    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
              return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
