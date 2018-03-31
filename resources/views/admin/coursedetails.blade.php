@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการคอร์สเรียน</h3>
      <a href="{{ url('/') }}/admin/courses" class="btn">ย้อนกลับ</a>
      <a href="{{ url('/') }}/course/{{ $data->id }}/preview/{{ $data->section[0]->lecture[0]->id }}" 
        target="_blank"class="btn">ดูเนื้อหาบทเรียน</a>
      <button class="print-btn btn">พิมพ์</button>
    </div>

    <h4>รายละเอียดคอร์สเรียน</h4>
    <table id="print-content" class="bordered">
      <tr>
        <td>Course ID</td>
        <td>{{ $data->id }}</td>
      </tr>
      <tr>
        <td>Title</td>
        <td>{{ $data->title }}</td>
      </tr>
      <tr>
        <td>Slug</td>
        <td>{{ $data->slug }}</td>
      </tr>
      <tr>
        <td>Subtitle</td>
        <td>{{ $data->subtitle }}</td>
      </tr>
      <tr>
        <td>Description</td>
        <td>{{ $data->description }}</td>
      </tr>
      <tr>
        <td>Language</td>
        <td>{{ $data->language }}</td>
      </tr>
      <tr>
        <td>Level</td>
        <td>{{ $data->level }}</td>
      </tr>
      <tr>
        <td>Image</td>
        <td><img height="150" src="/{{ $data->cover_image }}"></td>
      </tr>
      <tr>
        <td>Status</td>
        <td>{{ $data->status }}</td>
      </tr>
      <tr>
        <td>Price</td>
        <td>{{ $data->price }}</td>
      </tr>
      <tr>
        <td>License</td>
        <td>{{ $data->license }}</td>
      </tr>
      <tr>
        <td>Admin Feedback</td>
        <td>{{ $data->admin_feedback }}</td>
      </tr>
      <tr>
        <td>Promotion ID</td>
        <td>{{ $data->promotion_id }}</td>
      </tr>
      <tr>
        <td>Category ID</td>
        <td>{{ $data->category_id }}</td>
      </tr>
      <tr>
        <td>Instructor ID</td>
        <td>{{ $data->instructor_id }}</td>
      </tr>
    </table>
  </div>

@endsection