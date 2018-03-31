<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditAccountRequest extends FormRequest
{
  public function authorize()
  {
      return true;
  }

  public function rules()
  {
    return [
      'new_email' => 'required|email|max:50',
      'email_password' => 'required|min:4|max:20'
    ];
  }

  public function messages()
  {
    return [
      'email_password.required' => 'กรุณากรอกรหัสผ่าน',
      'email_password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 4 ตัวอักษร',
      'email_password.max' => 'รหัสผ่านต้องมีความยาวไม่เกิน 20 ตัวอักษร',
      'new_email.required' => 'กรุณากรอกอีเมล์',
      'new_email.email' => 'อีเมล์ผิดรูปแบบ',
      'new_email.max' => 'อีเมล์ต้องมีความยาวไม่เกิน 50 ตัวอักษร'
    ];
  }
}
