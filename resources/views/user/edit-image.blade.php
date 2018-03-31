@extends('user.template-edit')

@section('user-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>อัพโหลดรูปโปรไฟล์</h4>
    </div>
  </div> 

  <div class="col s9">
    <div class="container">
      
      {{--  PREVIEW IMAGE  --}}
      <div class="col s12">
        <img id="profile-img-tag" src="{{ url('/') }}/{{ $data->student->photo }}" style="width:100%; height:300px;"> 
      </div>

      <form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/') }}/user/edit-image">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        {{--  IMAGE FILE  --}}
        <div class="file-field input-field">
          <div class="btn">
            <span>ค้นหา</span>
            <input type="file" name="photo" id="photo">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Select .png .jpg file">
          </div>
        </div>
        <div class="photo error-msg col s12 red" style="display:none;"></div>
      
        {{--  SUBMIT BUTTON  --}}
        <div class="center-align">
          <button type="submit" style="margin-bottom: 50px;"class="btn btn-submit">
            บันทึก
          </button> 
        </div>
      </form>
    </div>
  </div>

  {{--  AJAX REQUEST IMAGE  --}}
  <script type="text/javascript">
    $(".btn-submit").on("click",function(e) {
      $(".btn-submit").toggleClass('disabled');
      loadingToast();

      $(this).parents("form").ajaxForm({ 
        complete: function(response) 
        {
          Materialize.Toast.removeAll();
          setTimeout(function () {
            if ($.isEmptyObject(response.responseJSON.error)) {
              successToast();

              $("#testimg").fadeOut(500, function() {
                  $("#testimg").html(`<img id="user_avatar" src="{{ url('/') }}/`
                    +response.responseJSON.success + `" style="height:200px; width:200px;"> `)
                    .fadeIn(750); 
              });
            }
            else {
              failToast();
              printErrorMsg(response.responseJSON.error);
            }            
          }, 500);

          $(".btn-submit").toggleClass('disabled');
        },
        error: function(response) 
        {
          setTimeout(function () {
            errorToast();
          }, 500);
        }
      });
    });

  </script>

  {{--  PREVIEW IMAGE JS  --}}
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
          $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#photo").change(function(){
        readURL(this);
    });
  </script>

@endsection
