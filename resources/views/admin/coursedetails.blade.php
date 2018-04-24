@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการคอร์สเรียน</h3>
      <a href="{{ url('/') }}/admin/courses" class="btn">ย้อนกลับ</a>
      <button class="print-btn btn">พิมพ์</button>
      @if ( count($data->section) > 0 )
        <a href="{{ url('/') }}/course/{{ $data->id }}/preview/{{ $data->section[0]->lecture[0]->id }}" 
          target="_blank"class="btn">ดูเนื้อหาบทเรียน</a>
      @else
        <span style="color:red;">ยังไม่มีเนื้อหาบทเรียน</span>
      @endif
    </div>

    <h4>รายละเอียดคอร์สเรียน</h4>
    <table id="print-content" class="bordered">
      <tr>
        <td>รหัสคอร์ส</td>
        <td>{{ $data->id }}</td>
      </tr>
      <tr>
        <td>ชื่อ</td>
        <td>{{ $data->title }}</td>
      </tr>
      <tr>
        <td>ลิงค์</td>
        <td>{{ $data->slug }}</td>
      </tr>
      <tr>
        <td>ชื่อรอง</td>
        <td>{{ $data->subtitle }}</td>
      </tr>
      <tr>
        <td>คำอธิบาย</td>
        <td>{{ $data->description }}</td>
      </tr>
      <tr>
        <td>ภาษา</td>
        <td>{{ $data->language }}</td>
      </tr>
      <tr>
        <td>ระดับ</td>
        <td>{{ $data->level }}</td>
      </tr>
      <tr>
        <td>รูปภาพ</td>
        <td><img height="150" src="/{{ $data->cover_image }}"></td>
      </tr>
      <tr>
        <td>สถานะ</td>
        <td>{{ $data->status }}</td>
      </tr>
      <tr>
        <td>ราคา</td>
        <td>{{ $data->price }}</td>
      </tr>
      <tr>
        <td>การอนุญาต</td>
        <td>{{ $data->license }}</td>
      </tr>
      <tr>
        <td>ความเห็นผู้ดูแล</td>
        <td>{{ $data->admin_feedback }}</td>
      </tr>
      <tr>
        <td>รหัสโปรโมชั่น</td>
        <td>{{ $data->promotion_id }}</td>
      </tr>
      <tr>
        <td>รหัสประเภทคอร์ส</td>
        <td>{{ $data->category_id }}</td>
      </tr>
      <tr>
        <td>รหัสผู้สอน</td>
        <td>{{ $data->instructor_id }}</td>
      </tr>
    </table>
  </div>

@endsection