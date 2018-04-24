@extends('course.template-edit')

@section('course-edit')

  <div class="col s9">
    <div class="center-align" style="margin-bottom:25px;">
      <h4>การตั้งค่าการเผยแพร่</h4>
    </div>

    <div>
      @if ($data->license == 'NOT')
        <div style="margin-bottom:5px;">
          คอร์สเรียนของท่านยังไม่ได้ผ่านการตรวจสอบ
          <form action="{{ url('/') }}/course/{{ $data->id }}/setting" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="course_id" value="{{ $data->id }}">
            
            <button class="btn">ส่งให้ผู้ดูแลตวจสอบ</button>
          </form>
        </div>

        <div>
          <form action="{{ url('/') }}/course/{{ $data->id }}/delete" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <input type="hidden" name="course_id" value="{{ $data->id }}">
          
            <button class="btn red">ลบคอร์สเรียน</button>
          </form>
        </div>
      @elseif ($data->license == 'PENDING')
        <div>
          คอร์สเรียนของท่านอยู่ระหว่างการตรวจสอบ
          <div>
            <button class="btn disabled">ส่งให้ผู้ดูแลตวจสอบ</button>
          </div>
        </div>

      @elseif ($data->license == 'PASS')
        <div style="color:teal;">เนื้อหาคอร์สเรียนของท่านได้ถูกตรวจสอบ และถูกเผยแพร่แล้ว</div>

      @elseif ($data->license == 'BAN')
        <div style="color:red;">คอร์สเรียนของท่านถูกระงับการเผยแพร่</div>

      @endif
    </div><br>

    <div class="divider"></div><br>

    <div>สถานะคอร์สเรียน: {{ $data->status }}</div>
    <div>ความเห็นแอดมิน: {{ $data->admin_feedback }}</div>
  </div>

@endsection