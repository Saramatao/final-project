<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditPasswordRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'current_password' => 'required',
      'new_password' => 'required|min:4|max:20',
      'confirm_password' => 'same:new_password'
    ];
  }

  public function messages()
  {
    return [
      'current_password.required' => 'กรุณากรอกรหัสผ่านปัจจุบัน',
      'new_password.required' => 'กรุณากรอกรหัสผ่านใหม่',
      'new_password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 4 ตัวอักษร',
      'new_password.max' => 'รหัสผ่านต้องมีความยาวไม่เกิน 20 ตัวอักษร',
      'confirm_password.same' => 'กรุณากรอกรหัสผ่านยืนยันให้ตรงกับรหัสผ่านใหม่'
    ];
  }
}
