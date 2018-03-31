<div class="center-align">

  <div style="height:150px; width:100%; margin-top:10px;" class="card hoverable rounded">
    <div id="testimg">
      <img id="user_avatar" src="{{ url('/') }}/{{ $data->student->photo }}" 
        style="height:150px; width:200px;"> 
    </div>
    
  </div>

  <div>
    <h5> {{ $data->name }} {{ $data->last_name }} </h5>
  </div>
  
  <div class="left-align collection hoverable" style="margin-bottom: 10px;">
    <a class="collection-item" href="{{ url('/') }}/user/edit-profile">ข้อมูลโปรไฟล์สาธารณะ</a>
    <a class="collection-item" href="{{ url('/') }}/user/edit-image">แก้ไขรูปโปรไฟล์</a>
    <a class="collection-item" href="{{ url('/') }}/user/edit-account">แก้ไขบัญชีผู้ใช้</a>
    <a class="collection-item" href="{{ url('/') }}/user/edit-password">เปลี่ยนรหัสผ่าน</a>
    <a class="collection-item" href="{{ url('/') }}/user/edit-privacy">ความเป็นส่วนตัว</a>
    <a class="collection-item" href="{{ url('/') }}/user/edit-notification">ตั้งค่าการแจ้งเตือน</a>
  </div>

</div>