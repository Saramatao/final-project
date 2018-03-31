<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditProfileRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'between:3,50|alpha',
      'last_name' => 'max:50|alpha|nullable',
      'headline' => 'min:50',
      'biography' => 'max:1000',
      'website' => 'max:50',
      'twitter' => 'max:50',
      'facebook' => 'max:50',
      'linkedin' => 'max:50',
      'youtube' => 'max:50',
      'github' => 'max:50'
    ];
  }

  public function messages()
  {
    return [
      'name.between' => 'ชื่อต้องมีความยาวอย่างน้อย 3 - 50 ตัวอักษร',
      'name.alpha' => 'ชื่อต้องประกอบด้วยตัวอักษรเท่านั้น',
      'last_name.alpha' => 'นามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น',
      'last_name.max' => 'นามสกุลต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'headline.min' => 'หน้าที่การงานต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'biography.max' => 'ประวัติโดยย่อต้องมีความยาวไม่เกิน 1000 ตัวอักษร',
      'website.max' => 'เว็บไซต์ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'twitter.max' => 'Twitter ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'facebook.max' => 'Facebook ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'linkedin.max' => 'LinkedIn ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'youtube.max' => 'Youtube ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'github.max' => 'GitHub ต้องมีความยาวไม่เกิน 50 ตัวอักษร'
    ];
  }
}
