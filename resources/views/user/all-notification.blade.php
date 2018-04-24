@extends('layouts.app')

@section('content')

  <div class="row pc-container white" style="margin-bottom:0; min-height:550px; margin-top:25px;">
    <h3>การแจ้งเตือน <a href="/read-all-noti" class="btn btn-inline">ลบทั้งหมด</a> </h3>
    <table class="highlight">
      <thead>
        <tr>
          <th>รูปแบบ</th>
          <th>สถานะ</th>
          <th>แจ้งเตือน</th>
          <th>วันเวลา</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($notifications as $noti)
          <tr>
            <td>{{ $noti->type }}</td>
            <td>{{ $noti->status }}</td>
            <td>{{ $noti->message }}</td>
            <td>{{ $noti->created_at }}</td>
            <td> <a href="read-noti/{{ $noti->id }}" class="btn">ไปยัง</a> </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection