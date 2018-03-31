@extends('course.template-edit')

@section('course-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>ข้อมูลเบื้องต้นของคอร์สเรียน</h4>
    </div>

    {{--  FORM TITLE --}}
    <form class="form_title">
      {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $data->id }}">

      {{--  TITLE  --}}
      <div class="input-field col s12">
        <input name="title" type="text" data-length="50"
          class="validate" style="margin-bottom:0;" value="{{ $data->title }}">
        <label class="active" for="title">ชื่อคอร์สเรียน</label>
      </div>
      <div class="title error-msg col s12 red" style="display:none;"></div>

      {{--  SUBTITLE  --}}
      <div class="input-field col s12">
        <input name="subtitle" type="text" data-length="50"
          class="validate" style="margin-bottom:0;" value="{{ $data->subtitle }}">
        <label class="active" for="subtitle">ชื่อสำรอง</label>
      </div>
      <div class="subtitle error-msg col s12 red" style="display:none;"></div>

      {{--  DESCRIPTION  --}}
      <div class="input-field col s12">
        <textarea name="description" data-length="1000"
          class="materialize-textarea" style="margin-bottom:0;">{{ $data->description }}</textarea>
        <label class="active" for="description">คำอธิบายคอร์สเรียน</label>
      </div>
      <div class="description error-msg col s12 red" style="display:none;"></div>

      {{--  DIFFICULTY  --}}
      <div class="input-field col s4">
        <select name="level">
          <option value="" disabled selected>เลือกระดับความยาก</option>
          <option value="ระดับง่าย"
            {{ ($data->level == 'ระดับง่าย') ? 'selected' : '' }}>ระดับง่าย</option>
          <option value="ระดับปานกลาง"
            {{ ($data->level == 'ระดับปานกลาง') ? 'selected' : '' }}>ระดับปานกลาง</option>
          <option value="ระดับยาก"
            {{ ($data->level == 'ระดับยาก') ? 'selected' : '' }}>ระดับยาก</option>
        </select>
        <label>ระดับความยาก</label>
      </div>

      {{--  LANGUAGE  --}}
      <div class="input-field col s4">
        <select name="language">
          <option value="" disabled selected>เลือกภาษาที่ใช้ในคอร์สเรียน</option>
          <option value="ภาษาไทย" 
            {{ ($data->language == 'ภาษาไทย') ? 'selected' : '' }}>ภาษาไทย</option>
          <option value="English" 
            {{ ($data->language == 'English') ? 'selected' : '' }}>English</option>
        </select>
        <label>ภาษาที่ใช้ในคอร์สเรียน</label>
      </div>

      {{--  CATEGORY  --}}
      <div class="input-field col s4">
        <select name="category_id">
          <option value="" disabled selected>เลือกประเภทของคอร์สเรียน</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"
              {{ ($data->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
          @endforeach
        </select>
        <label>ประเภทคอร์สเรียน</label>
      </div>

      {{--  SUBMIT BUTTON  --}}
      <div class="center-align">
        <button type="submit" class="btn btn-submit mar-top-25 mar-bot-25">
          บันทึก
        </button> 
      </div>
    </form>

    {{--  ===========================================================================  --}}
    {{--  ===========================================================================  --}}

    {{--  PREVIEW IMAGE  --}}
    <div class="col s5">
      <img id="img-tag" src="{{ url('/') }}/{{ $data->cover_image }}" 
        style="width:100%; height:200px;"> 
    </div>

    {{--  FORM IMAGE  --}}
    <form role="form" method="POST" action="{{ url('/') }}/course/image" enctype="multipart/form-data">
      {{ method_field('PATCH') }}
      {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $data->id }}">

      {{--  COVER IMAGE  --}}
      <div class="file-field input-field col s7">
        <div style="font-size:1.5em;">
          รูปหน้าปก
        </div>
        <div>
          เลือกรูปภาพหน้าปกสำหรับคอร์สเรียนของท่าน ด้วยไฟล์รูปภาพ .png .jpg ที่มีขนาดไม่เกิน 2 MB
        </div>
        <div>
          <div class="btn">
            <span>ค้นหา</span>
            <input type="file" name="cover_image" id="cover_image">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Select .png .jpg file">
          </div>
        </div>
      </div>
      <div class="cover_image error-msg col s12 red" style="display:none;"></div>

      {{--  SUBMIT BUTTON  --}}
      <div class="center-align">
        <button type="submit" class="btn btn-submit img-submit mar-top-25 mar-bot-25">
          บันทึก
        </button> 
      </div>
    </form>
  </div> 

  {{--  AJAX REQUEST  --}}
  <script type="text/javascript">
    $(document).ready(function() {

      // TITLE
      $("form.form_title").submit(function(e) {
        e.preventDefault();
        var form = $(this);

        ajaxFormRequest(form, function(result) {
          console.log(result);
        }, {
          method: "PATCH",
          action: '{{ url('/')}}/course/title'
        });

      });

      // COVER IMAGE
      $(".img-submit").on("click",function(e) {
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
                    $("#testimg").html(`<img id="cover_image" src="{{ url('/') }}/`
                      +response.responseJSON.success + `" style="height:175px; width:250px;">`)
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

    });
  </script>

  {{--  PREVIEW IMAGE JS --}}
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
          $('#img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#cover_image").change(function(){
        readURL(this);
    });
  </script>

@endsection