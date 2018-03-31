@extends('user.template-edit')

@section('user-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>แก้ไขการแจ้งเตือน</h4>
    </div>
  </div> 

  <div class="col s9">
    <div class="container">
    
      <form role="form" method="POST" action="/user/edit-notification">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        {{--  ALLOW PRO EMAIL  --}}
        <div class="switch" style="margin-bottom:10px;">
          <label>
            @if($data->student->allow_pro_email == 'Y')
              <input type="checkbox" id="allow_pro_email" name="allow_pro_email" checked="checked">
            @else
              <input type="checkbox" id="allow_pro_email" name="allow_pro_email">
            @endif
            <span class="lever"></span>
              รับการแจ้งเตือนข้อเสนอโปรโมชั่น แนะนำคอร์สเรียนและข่าวสารที่เป็นประโยชน์
          </label>
        </div>

        {{--  ALLOW IMP UPDATE  --}}
        <div class="switch" style="margin-bottom:10px;">
          <label>
            @if($data->student->allow_imp_update == 'Y')
              <input type="checkbox" id="allow_imp_update" name="allow_imp_update"  checked="checked">
            @else
              <input type="checkbox" id="allow_imp_update" name="allow_imp_update">
            @endif
            <span class="lever"></span>
              รับการแจ้งเตือนการอัปเดตสำคัญต่างๆจากเว็บไซต์
          </label>
        </div>

        {{--  ALLOW ANNOUNCEMENT  --}}
        <div class="switch" style="margin-bottom:10px;">
          <label>
            @if($data->student->allow_announcement == 'Y')
              <input type="checkbox" id="allow_announcement" name="allow_announcement" checked="checked">
            @else
              <input type="checkbox" id="allow_announcement" name="allow_announcement">
            @endif
            <span class="lever"></span>
              รับการแจ้งเตือนประกาศจากผู้สอนของคอร์สที่ลงทะเบียน
          </label>
        </div>

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
        var allow_pro_email =  $('#allow_pro_email').is(':checked');
        var allow_imp_update =  $('#allow_imp_update').is(':checked');
        var allow_announcement =  $('#allow_announcement').is(':checked');

        $.ajax({
          url: '/user/edit-notification',
          type: 'PATCH',
          data: {_token: _token, 
            allow_pro_email: allow_pro_email,
            allow_imp_update: allow_imp_update,
            allow_announcement: allow_announcement
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