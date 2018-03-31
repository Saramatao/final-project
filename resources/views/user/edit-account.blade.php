@extends('user.template-edit')

@section('user-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>แก้ไขบัญชีผู้ใช้</h4>
    </div>
  </div> 

  <div class="col s9">
    <div class="container">

      <form role="form" method="POST" action="/user/edit-account">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="input-field col s12">
          <input disabled id="current_email" name="email" type="email" 
            class="validate" data-length="50" style="margin-bottom:0;" value="{{ $data->email }}">
          <label class="active" for="email">อีเมล์</label>
        </div>

        <div class="input-field col s12">
          <input id="new_email" name="new_email" type="email"
            class="validate" data-length="50" style="margin-bottom:0;">
          <label class="active" for="new_email">อีเมล์ใหม่</label>
        </div>
        <div class="new_email error-msg col s12 red" style="display:none;"></div>

        <div class="input-field col s12">
          <input id="email_password" name="email_password" type="password" 
            class="validate" data-length="20" style="margin-bottom:0;">
          <label class="active" for="email_password">รหัสผ่าน</label>
        </div>
        <div class="email_password error-msg col s12 red" style="display:none;"></div>

        <div class="center-align">
          <button type="submit" style="margin-top:25px; margin-right:10px;" class="btn btn-submit">
            บันทึก
          </button> 
        </div>

      </form>

    </div>
  </div> 

  {{--  AJAX  --}}
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
        var new_email = $("input[name='new_email']").val();
        var email_password = $("input[name='email_password']").val();

        $.ajax({
          url: "/user/edit-account",
          type:'PATCH',
          data: {_token: _token, 
            new_email: new_email, 
            email_password: email_password
          },
          success: function(data) {
            if (data.success) {
              $("#current_email").val(data.success);
              $("#new_email").val('');
              $("#email_password").val('');
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