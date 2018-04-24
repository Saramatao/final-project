@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการคอร์สเรียน</h3>
      <a href="/admin/courses" class="btn">ดูคอร์สทั้งหมด</a>
      <a href="" class="btn">โหลดใหม่</a>
      <button class="print-btn btn">พิมพ์</button>
    </div>

    {{--  HIDE/SHOW CHECKBOXES  --}}
    <table class="col check-box-container">
      <thead>
        <tr>
          <td>
            <input type="checkbox" class="filled-in" id="0" checked="checked" />
            <label for="0">รหัส & ลิงค์</label>
          </td>
          <td>
            <input type="checkbox" class="filled-in" id="1" checked="checked" />
            <label for="1">รายละเอียดย่อย</label>
          </td>
          <td>
            <input type="checkbox" class="filled-in" id="2" checked="checked" />
            <label for="2">สถานะ</label>
          </td>
          <td>
            <input type="checkbox" class="filled-in" id="3" checked="checked" />
            <label for="3">อื่นๆ</label>
          </td>
        </tr>
      </thead>
    </table>
  </div>

  {{--  DATA TABLE  --}}
  <div id="print-content" class="w90 auto-margin" style="overflow: auto;">
    <table class="bordered responsive-table" id="myTable">
      <thead>
        <tr>
          <th class="0" onclick="sortTable(0)">รหัสคอร์ส</th>
          <th class="1" onclick="sortTable(1)">ชื่อ</th>
          <th class="0" onclick="sortTable(2)">ลิงค์</th>
          <th class="1" onclick="sortTable(3)">ชื่อรอง</th>
          <th class="1" onclick="sortTable(4)">คำอธิบาย</th>
          <th class="1" onclick="sortTable(5)">ภาษา</th>
          <th class="1" onclick="sortTable(6)">ระดับ</th>
          <th class="1">ปก</th>
          <th class="1">วีดีโอ</th>
          <th class="2" onclick="sortTable(9)">สถานะ</th>
          <th class="2" onclick="sortTable(10)">ราคา</th>
          <th class="2" onclick="sortTable(11)">การอนุญาต</th>
          <th class="2" onclick="sortTable(12)">ความเห็นผู้ดูแล</th>
          <th class="3" onclick="sortTable(13)">ประเภท</th>
          <th class="3" onclick="sortTable(14)">รหัสโปรโมชั่น</th>
          <th class="3" onclick="sortTable(15)">รหัสผู้สอน</th>
          <th class="3" onclick="sortTable(16)">วันที่สร้าง</th>
        </tr>
      </thead>

      <tbody>
        @foreach($data as $course)
          <tr>
            <td class="0 tooltipped" data-tooltip="{{ $course->id }}">{{ $course->id }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $course->title }}">{{ $course->title }}</td>
            <td class="0 tooltipped" data-tooltip="{{ $course->slug }}">{{ $course->slug }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $course->subtitle }}">{{ $course->subtitle }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $course->description }}">{{ $course->description }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $course->language }}">{{ $course->language }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $course->level }}">{{ $course->level }}</td>
            <td class="1"><a href="{{ url('/') }}/{{ $course->cover_image }}" target="_blank">Link</a></td>
            <td class="1"><a href="{{ url('/') }}/{{ $course->promote_vdo }}" target="_blank">Link</a></td>
            <td class="2 tooltipped" data-tooltip="{{ $course->status }}">{{ $course->status }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $course->price }}">{{ $course->price }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $course->license }}">{{ $course->license }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $course->admin_feedback }}">{{ $course->admin_feedback }}</td>
            @if ( $course->category != null )
              <td class="3 tooltipped" data-tooltip="{{ $course->category->name }}">{{ $course->category->name }}</td>
            @else 
              <td class="3"></td>
            @endif
            @if ( $course->promotion != null )
              <td class="3 tooltipped" data-tooltip="{{ $course->promotion->id }}">{{ $course->promotion->id }}</td>
            @else 
              <td class="3"></td>
            @endif
            @if ( $course->user != null )
              <td class="3 tooltipped" data-tooltip="{{ $course->user->id }}">{{ $course->user->id }}</td>
            @else 
              <td class="3"></td>
            @endif
            <td class="3 tooltipped" data-tooltip="{{ $course->created_at }}">{{ $course->created_at }}</td>
            <input type="hidden" name="_title" value="{{ $course->title }}">
            <input type="hidden" name="_course_id" value="{{ $course->id }}">
            <input type="hidden" name="_admin_feedback" value="{{ $course->admin_feedback }}">
            <input type="hidden" name="_license" value="{{ $course->license }}">
            <input type="hidden" name="_slug" value="{{ $course->slug }}">
          </tr>
        @endforeach
      </tbody>
    </table>

    {{--  PAGINATION  --}}
    <div class="center-align">
      {{ $data->links() }}
    </div>
  </div>

  {{--  MODAL BOX COURSE SETTING  --}}
  <div id="modal2" class="modal" style="width:650px; overflow:hidden;">
    <div class="modal-content">
      <h4 id="course-modal-header" class="center-align">ตั้งค่าคอร์สเรียน</h4>
      <form method="POST" action="{{ url('/') }}/course/license">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="course_id">

        <div class="input-field col">
          <label for="admin_feedback" class="active" style="width:100%">ความคิดเห็น</label>
          <textarea type="text" name="admin_feedback" 
            class="validate materialize-textarea" data-length="500"></textarea>
        </div>

        <div class="input-field col">
          <select name="license">
            <option value="" disabled selected>ไม่เปลี่ยนแปลง</option>
            <option value="NOT" id='NOT'>ยังไม่อนุญาต</option>
            <option value="PASS" id='PASS'>อนุญาตการเผยแพร่</option>
            <option value="BAN" id='BAN'>ระงับการเผยแพร่</option>
          </select>
          <label>
            ตั้งค่าการอนุญาต
          </label>
        </div>

        <div class="input-field col">
          <label for="slug" class="active" style="width:100%">URL ของคอร์สเรียน</label>
          <input type="text" name="slug" class="validate" data-length="50">
        </div>

        <div class="center-align mar-top-25">
          <button type="submit" style="margin-top:10px; margin-bottom:10px; width:255px;" 
            class="btn btn-submit waves-effect">
            บันทึกการเปลี่ยนแปลง
          </button> 
        </div>
      </form>

      <div class="center-align">
        @if (isset($course))
          <a href="{{ url('/') }}/admin/courses/{{ $course->id }}" 
            id="course-details-btn" class="btn">ดูรายละเอียด</a>
        @endif
      </div>
    </div>
  </div>

  {{--  SEARCH COURSE MODAL  --}}
  <div id="modal3" class="modal" style="width:650px; overflow:hidden;">
    <div class="modal-content">
      <h4 class="center-align">ค้นหาคอร์สเรียน</h4>
      <form method="POST">
        {{ csrf_field() }}

        <div class="input-field col">
          <label for="course_id" class="active">Course_ID</label>
          <input type="text" name="course_id">
        </div>

        <div class="input-field col">
          <label for="slug" class="active">Slug</label>
          <input type="text" name="slug">
        </div>

        <div class="input-field col">
          <label for="promotion_id" class="active">Promotion_ID</label>
          <input type="text" name="promotion_id">
        </div>

        <div class="center-align mar-top-25">
          <button type="submit" style="margin-top:10px; margin-bottom:10px; width:255px;" 
            class="btn btn-submit waves-effect">
            Submit
          </button> 
        </div>
      </form>
    </div>
  </div>

  {{--  JS FUNCTIONS  --}}
  <script>
    $(document).ready(function(){

      setTimeout(function() {
        $('#1').click();
        $('#3').click();
      }, 1);

      // EDIT COURSE SETTING MODAL TRIGGER
      $('tbody tr').on('click', function(e){
        $('#modal2').modal('open');
        var course_id = $(this).find("input[name='_course_id']").val();
        var title = $(this).find("input[name='_title']").val();
        var feedback = $(this).find("input[name='_admin_feedback']").val();
        var slug = $(this).find("input[name='_slug']").val();
        var license = $(this).find("input[name='_license']").val();

        $('#course-modal-header').html(`
          <div>
           ` + course_id + `
          </div>
          <div>
           ` + title + `
          </div>
        `);

        $("input[name='course_id']").val(course_id);
        $("textarea[name='admin_feedback']").val(feedback);
        $("input[name='slug']").val(slug);

        $("textarea[name='admin_feedback']").focus();
        $("input[name='slug']").focus();
        $("#course-details-btn").attr('href', '/admin/courses/'+course_id);
      });

      // SEARCH COURSE MODAL TRIGGER
      $('.search-btn').on('click', function(e){
        $('#modal3').modal('open');
      });
    });
  </script>

@endsection