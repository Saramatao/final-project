@extends('course.template-edit')

@section('course-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>รายละเอียดย่อยของคอร์สเรียน</h4>
    </div>

    {{--  ====================================================================  --}}
    {{--  ====================================================================  --}}

    <h5>กลุ่มเป้าหมายของคอร์สเรียน</h5>
    <form role="form" method="POST" action="{{ url('/') }}/course/target">
      {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $data->id }}">

  
      {{--  TARGET  --}}
      @foreach ($data->target as $target)
        <div class="input-field mar-bot-25 col s11">
          <input name="target[]" type="text" data-length="100"
            class="validate" style="margin-bottom:0;" value="{{ $target->detail }}">
          <label class="active" for="target">กลุ่มเป้าหมาย</label>
        </div>
        <i class="material-icons del-but col s1 mar-top-25">delete</i>
      @endforeach
      <div class="target-content"></div>

      {{--  SUBMIT BUTTON  --}}
      <div class="center-align mar-bot-25">
        <div class="btn add-target">
          เพิ่ม
        </div> 
        <button type="submit" class="btn btn-submit">
          บันทึก
        </button> 
      </div>
    </form>

    {{--  ====================================================================  --}}
    {{--  ====================================================================  --}}

    <h5>ประโยชน์ที่จะได้รับจากคอร์สเรียน</h5>
    <form role="form" method="POST" action="{{ url('/') }}/course/benefit">
      {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $data->id }}">

      {{--  BENEFIT  --}}
      @foreach ($data->benefit as $benefit)
        <div class="input-field mar-bot-25 col s11">
          <input name="benefit[]" type="text" data-length="100"
            class="validate" style="margin-bottom:0;" value="{{ $benefit->detail }}">
          <label class="active" for="benefit">ผลประโยชน์ที่ได้รับ</label>
        </div>
        <i class="material-icons del-but col s1 mar-top-25">delete</i>
      @endforeach
      <div class="benefit-content"></div>

      {{--  SUBMIT BUTTON  --}}
      <div class="center-align mar-bot-25">
        <div class="btn add-benefit">
          เพิ่ม
        </div> 
        <button type="submit" class="btn btn-submit">
          บันทึก
        </button> 
      </div>
    </form>

    {{--  ====================================================================  --}}
    {{--  ====================================================================  --}}

    <h5>สิ่งที่ผู้เรียนจำเป็นต้องรู้ก่อน</h5>
    <form role="form" method="POST" action="{{ url('/') }}/course/prerequisite">
      {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $data->id }}">

      {{--  PREREQUISITE  --}}
      @foreach ($data->prerequisite as $prerequisite)
        <div class="input-field mar-bot-25 col s11">
          <input name="prerequisite[]" type="text" data-length="100"
            class="validate" style="margin-bottom:0;" value="{{ $prerequisite->detail }}">
          <label class="active" for="prerequisite">สิ่งที่ต้องรู้ก่อนเรียน</label>
        </div>
        <i class="material-icons del-but col s1 mar-top-25">delete</i>
      @endforeach
      <div class="prerequisite-content"></div>

      {{--  SUBMIT BUTTON  --}}
      <div class="center-align mar-bot-25">
        <div class="btn add-prerequisite">
          เพิ่ม
        </div> 
        <button type="submit" class="btn btn-submit">
          บันทึก
        </button> 
      </div>
    </form>

    {{--  ====================================================================  --}}
    {{--  ====================================================================  --}}

  </div>
  
  {{--  AJAX REQUEST  --}}
  <script type="text/javascript">
    $(document).ready(function() {
      $("form").submit(function(e) {
        e.preventDefault();
        ajaxFormRequest($(this));
      });
    });
  </script>
  
  {{--  JS FUNCTIONS  --}}
  <script type="text/javascript">
    $(document).ready(function() {
      var count_target = ({{ $data->count_target }});
      var count_benefit = ({{ $data->count_benefit }});
      var count_prerequisite = ({{ $data->count_prerequisite }});

      $(".add-target").on("click", function(e) {
        if (count_target < 10 )
          $('.target-content').append(`
            <div class="input-field mar-bot-25 col s11">
              <input name="target[]" type="text" data-length="100"
                class="validate" style="margin-bottom:0;">
              <label class="active" for="target">กลุ่มเป้าหมาย</label>
            </div>
          `);

        count_target++;
      });

      $(".add-benefit").on("click", function(e) {
        if (count_benefit < 10 )
          $('.benefit-content').append(`
            <div class="input-field mar-bot-25 col s11">
              <input name="benefit[]" type="text" data-length="100"
                class="validate" style="margin-bottom:0;">
              <label class="active" for="benefit">ผลประโยชน์ที่ได้รับ</label>
            </div>
          `);

        count_benefit++;
      });

      $(".add-prerequisite").on("click", function(e) {
        if (count_prerequisite < 10 )
          $('.prerequisite-content').append(`
            <div class="input-field col s12">
              <input name="prerequisite[]" type="text" data-length="100"
                class="validate" style="margin-bottom:0;">
              <label class="active" for="prerequisite">สิ่งที่ต้องรู้ก่อนเรียน</label>
            </div>
          `);

        count_prerequisite++;
      });

      $(".del-but").on("click", function(e) {
        $(this).prev().remove();
        $(this).remove();
      });

    });
  </script>

@endsection