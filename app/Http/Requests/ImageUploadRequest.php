<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
  public function authorize()
  {
      return true;
  }

  public function rules()
  {
    return [
      'photo' => 'image|mimes:jpg,jpeg,png|max:1024|required'
    ];
  }

  public function messages()
  {
    return [
      'photo.max' => 'ขนาดของรูปภาพต้องไม่เกิน 1024 กิโลไบต์ (1 MB)',
      'photo.uploaded' => 'ไฟล์รูปภาพรองรับเฉพาะ .jpg .jpeg .png เท่านั้น'
    ];
  }
}
