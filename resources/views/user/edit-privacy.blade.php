@extends('user.template-edit')

@section('user-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>แก้ไขความเป็นส่วนตัว</h4>
    </div>
  </div> 

  <div class="col s9">
    <div class="container">

      <form role="form" method="POST" action="/user/edit-privacy">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        {{--  ALLOW PUB PROFILE  --}}
        <div class="switch" style="margin-bottom:10px;">
          <label>
            @if($data->student->allow_pub_profile == 'Y')
              <input type="checkbox" id="allow_pub_profile" name="allow_pub_profile" checked="checked">
            @else
              <input type="checkbox" id="allow_pub_profile" name="allow_pub_profile">
            @endif
            <span class="lever"></span>
              แสดงโปรไฟล์สาธารณะของฉัน
          </label>
        </div>

        {{--  ALLOW PUB COURSE  --}}
        <div class="switch" style="margin-bottom:10px;">
          <label>
            @if($data->student->allow_pub_course == 'Y')
              <input type="checkbox" id="allow_pub_course" name="allow_pub_course" checked="checked">
            @else
              <input type="checkbox" id="allow_pub_course" name="allow_pub_course">
            @endif
            <span class="lever"></span>
              แสดงคอร์สเรียนของฉัน
          </label>
        </div>

        {{--  ALLOW PUB TEACHING  --}}
        @unless(is_null($data->instructor))
          <div class="switch" style="margin-bottom:10px;">
            <label>
              @unless(is_null($data->instructor))
                @if($data->instructor->allow_pub_teaching == 'Y')
                  <input type="checkbox" id="allow_pub_teaching" name="allow_pub_teaching" checked="checked">
                @else
                  <input type="checkbox" id="allow_pub_teaching" name="allow_pub_teaching">
                @endif
              @endunless
              <span class="lever"></span>
                แสดงคอร์สที่ฉันเป็นผู้สอน
            </label>
          </div>
        @endunless

        {{--  SUBMIT BUTTON  --}}
        <div class="center-align">
          <button type="submit" style="margin-top:25px; margin-right:10px;" class="btn btn-submit">
            บันทึก
          </button> 
        </div>

      </form>

    </div> 
  </div>

  {{--  AJAX REQUEST  --}}
  <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-submit").click(function(e){
        e.preventDefault();
        $(".btn-submit").toggleClass('disabled');

        Materialize.toast(
          `<div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
          <div style="margin-left:20px;">กำลังบันทึกการเปลี่ยนแปลง</div>`)

        var _token = $("input[name='_token']").val();
        var allow_pub_profile =  $('#allow_pub_profile').is(':checked');
        var allow_pub_course =  $('#allow_pub_course').is(':checked');
        var allow_pub_teaching =  $('#allow_pub_teaching').is(':checked');

        $.ajax({
          url: '/user/edit-privacy',
          type: 'PATCH',
          data: {_token: _token, 
            allow_pub_profile: allow_pub_profile,
            allow_pub_course: allow_pub_course,
            allow_pub_teaching: allow_pub_teaching
          },
          success: function(data) {
            Materialize.Toast.removeAll();

            setTimeout(function () {
              Materialize.toast(
                '<div>บันทึกสำเร็จ!</div>', 1000);
            }, 500);

            $(".btn-submit").toggleClass('disabled');
          },
          error: function(data){
            Materialize.Toast.removeAll();
            alert('มีปัญหาขณะโหลดหน้าเว็บ กรุณาลองใหม่ภายหลัง');
            $(".btn-submit").toggleClass('disabled');
          }
        });
      }); 
    });
  </script>

@endsection