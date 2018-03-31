<div class="col s3">
  <div class="center-align">

    <div class="card hoverable" style="height:175px; width:100%;">
      <div id="testimg">
        <img id="course_cover_image" src="{{ url('/') }}/{{ $data->cover_image }}" 
          style="height:175px; width:250px;"> 
      </div>
    </div> 
    
    <div class="left-align collection hoverable">
      <a href="{{ url('/') }}/course/{{ $data->id }}/title" class="collection-item">ข้อมูลเบื้องต้น</a>
      <a href="{{ url('/') }}/course/{{ $data->id }}/cirriculum" class="collection-item">เนื้อหาบทเรียน</a>
      <a href="{{ url('/') }}/course/{{ $data->id }}/detail" class="collection-item">รายละเอียด</a>
      <a href="{{ url('/') }}/course/{{ $data->id }}/price-coupon" class="collection-item">ราคา, คูปอง</a>
      <a href="{{ url('/') }}/course/{{ $data->id }}/setting" class="collection-item">การตั้งค่า</a>
      <a href="{{ url('/') }}/home/teaching" class="collection-item">กลับสู่หน้าหลัก</a>
    </div>

  </div>
</div>