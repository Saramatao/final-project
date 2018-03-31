@extends('user.template-edit')

@section('user-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>เปลี่ยนรหัสผ่าน</h4>
    </div>
  </div> 

  <div class="col s9">
    <div class="container">

      <form role="form" method="POST" action="/user/edit-password">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        {{--  CURRENT PASSWORD  --}}
        <div class="input-field col s12">
          <input id="current_password" name="current_password" type="password" 
            class="validate" data-length="20" style="margin-bottom:0;">
          <label class="active" for="current_password">รหัสผ่านปัจจุบัน</label>
        </div>
        <div class="current_password error-msg col s12 red" style="display:none;"></div>

        {{--  NEW PASSWORD  --}}
        <div class="input-field col s12">
          <input id="new_password" name="new_password" type="password" 
            class="validate" data-length="20" style="margin-bottom:0;">
          <label class="active" for="new_password">รหัสผ่านใหม่</label>
        </div>
        <div class="new_password error-msg col s12 red" style="display:none;"></div>

        {{--  CONFIRM NEW PASSWORD  --}}
        <div class="input-field col s12">
          <input id="confirm_password" name="confirm_password" type="password" 
            class="validate" data-length="20" style="margin-bottom:0;">
          <label class="active" for="current_new_password">ยืนยันรหัสผ่านใหม่</label>
        </div>
        <div class="confirm_password error-msg col s12 red" style="display:none;"></div>

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
        var current_password =  $("input[name='current_password']").val()
        var new_password =  $("input[name='new_password']").val()
        var confirm_password =  $("input[name='confirm_password']").val()

        $.ajax({
          url: "/user/edit-password",
          type:'PATCH',
          data: {_token: _token, 
            current_password: current_password,
            new_password: new_password,
            confirm_password: confirm_password
          },
          success: function(data) {
            if (data.success) {
              $("#current_password").val('');
              $("#new_password").val('');
              $("#confirm_password").val('');
            }
            Materialize.Toast.removeAll();

            setTimeout(function () {
              if ($.isEmptyObject(data.error))
                Materialize.toast(
                  '<div>บันทึกสำเร็จ!</div>', 1000)
              else 
                Materialize.toast(
                  '<div>กรุณากรอกข้อมูลให้ตรงตามเงื่อนไข</div>', 2000, 'red');
            }, 500);

            printErrorMsg(data.error);
            $(".btn-submit").toggleClass('disabled');
          },
          error: function(data){
            Materialize.Toast.removeAll();
            alert('มีปัญหาขณะโหลดหน้าเว็บ กรุณาลองใหม่ภายหลัง');
            $(".btn-submit").toggleClass('disabled');
          }
        });
      }); 

      function printErrorMsg (msg) {
        $(".error-msg").html('');
        $(".error-msg").css('display', 'none');
        $.each( msg, function( key, value ) {
          
          $("." + key).css('display', 'block');
          $.each( value, function( index, val ) {
            $("." + key).append(val+"<br>"); 
          });
        });
      }
    });
  </script>

@endsection