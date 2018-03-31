<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use App\Models\User;
use App\Models\Student;

class CustomAuthController extends Controller
{
  public function manualLogin(Request $request) {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
      return response()->json(['success' => 'request succeed']);
    
    return response()->json(['error' => ['form' => ['เข้าสู่ระบบล้มเหลว อีเมล์หรือรหัสผ่านไม่ถูกต้อง']]]);
  }

  public function manualRegister(Request $request) {
    $rules = [
      'name'                  => 'min:3|max:100',
      'email'                 => 'unique:users|email',
      'password'              => 'min:4|max:30',
      'password_confirmation' => 'same:password'
    ];

    $messages = [
      'name.min'                    => 'ชื่อต้องมีความยาวอย่างน้อย 3 - 100 ตัวอักษร',
      'name.max'                    => 'ชื่อต้องมีความยาวอย่างน้อย 3 - 100 ตัวอักษร',
      'email.unique'                => 'อีเมล์นี้มีผู้ใช้แล้ว',
      'email.email'                 => 'รูปแบบอีเมล์ไม่ถูกต้อง',
      'password.min'                => 'รหัสผ่านต้องมีความยาวอย่างน้อย 4 - 30 ตัวอักษรหรือตัวเลข',
      'password.max'                => 'รหัสผ่านต้องมีความยาวอย่างน้อย 4 - 30 ตัวอักษรหรือตัวเลข',
      'password_confirmation.same'  => 'รหัสผ่านทั้งสองช่องไม่ตรงกัน'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails())
      return response()->json(['error'=>$validator->errors()]);

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
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);
      
    $student = new Student;
    $student->user_id = $rand_id[0];
    $student->save();

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
      return response()->json(['success' => 'request succeed']);
  
    return response()->json(['error' => ['form' => ['เข้าสู่ระบบล้มเหลว อีเมล์หรือรหัสผ่านไม่ถูกต้อง']]]);
  }
}
