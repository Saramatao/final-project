<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;
use App\Models\Student;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);
    }

    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    
    //     event(new Registered($user = $this->create($request->all())));
    
    //     $this->guard()->login($user);
    
    //     return $this->registered($request, $user)
    //                     ?: redirect($this->redirectPath());
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $id = '';
      $userid = '';
      while($id == $userid){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $id = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 10; $i++)
          $id .= $characters[mt_rand(0, $max)];
        if(User::find($id))
          $userid = User::find($id)->id;
      }
      $rand_id = array($id);

      $user = User::create([
        'id' => $rand_id[0],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password'])
      ]);
      
      $student = new Student;
      $student->user_id = $rand_id[0];
      $student->save();

      return $user;
    }
}
