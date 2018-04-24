@extends('course.template-edit')

@section('course-edit')

  <style>
    .add-vdo-btn, .add-pdf-btn, .add-txt-btn {
      margin-left:15%;
      border-bottom:1px solid grey;
    }

    .add-vdo-btn:hover, .add-pdf-btn:hover, .add-txt-btn:hover {
      cursor: pointer;
      border-bottom:1px solid black;
    }
  </style>

  <div class="col s9">
    <div class="center-align">
      <h4>เนื้อหาบทเรียน</h4>
    </div>

    {{--  ==========================================================================  --}}
    {{--  ==========================================================================  --}}

    {{--  SECTION  --}}
    @foreach ($data->section as $i => $section)

      <div class="mar-top-25 section-toggle btn col s12">
        แสดง/ซ่อน {{ $section->title }}
      </div>
      <fieldset class="mar-bot-25 hoverable"
        @if ($data->disable == true)
          disabled
        @endif
      >
        <legend> # {{ $i + 1 }} {{ $section->title }}</legend>
        <form method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="_method">
          <input type="hidden" name="section_sub_number" value="{{ $section->sub_number }}">

          {{--  TITLE  --}}
          <div class="input-field col s12">
            <input name="title" type="text" data-length="50"
              class="validate" style="margin-bottom:0;" value="{{ $section->title }}">
            <label class="active" for="title">ชื่อหัวข้อ</label>
          </div>

          {{--  OBJECTIVE  --}}
          <div class="input-field col s12">
            <input name="objective" type="text" data-length="50"
              class="validate" style="margin-bottom:0;" value="{{ $section->objective }}">
            <label class="active" for="objective">จุดมุ่งหมาย</label>
          </div>
          
          {{--  SAVE & DELETE SECTION  --}}
          <div class="center-align">
            <div class="btn save-sec-btn teal mar-top-25 mar-bot-25">บันทึก</div>
            <div class="btn del-sec-btn red mar-top-25 mar-bot-25">ลบทิ้ง</div>
          </div>
          
        </form>

        <div class="divider mar-bot-25"></div>
      
        {{--  LECTURE  --}}
        @foreach ($section->lecture as $lecture)
          <div>
            <form method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method">
              <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">

              {{--  TITLE  --}}
              <div style="display:flex;">
                <div class="input-field col s6">
                  <input name="title" type="text" data-length="50"
                    class="validate" style="margin-bottom:0;" value="{{ $lecture->title }}">
                  <label class="active" for="title">ชื่อบทเรียน</label>
                </div>
              
                {{--  STATUS  --}}
                <div class="col s6 mar-top-10">
                  <div style="color: #888">
                    ประเภทบทเรียน :
                    @if ($lecture->content_type == 'TXT')
                      บทความ
                      <a href="{{ url('/') }}/course/{{ $data->id }}/preview/{{ $lecture->id }}">preview</a>
                    @elseif ($lecture->content_type == 'PDF')
                      สไลด์
                      <a href="{{ url('/') }}/course/{{ $data->id }}/preview/{{ $lecture->id }}">preview</a>
                    @elseif ($lecture->content_type == 'VDO')
                      วิดีโอ
                      <a href="{{ url('/') }}/course/{{ $data->id }}/preview/{{ $lecture->id }}">preview</a>
                    @else
                      ยังไม่มี
                    @endif
                  </div>

                  <input name="status" type="radio" value="FREE" 
                  {{ ($lecture->status == 'FREE') ? 'checked' : '' }}>
                  <label class="radio-btn">ดูฟรี</label>

                  <input name="status" type="radio" value="LOCKED"
                  {{ ($lecture->status == 'LOCKED') ? 'checked' : '' }}>
                  <label class="radio-btn">ล้อค</label>
                  
                  {{--  SAVE & DELETE LECTURE --}}
                  <i class="material-icons save-lecture-btn mar-left-25" style="color:teal">save</i>
                  <i class="material-icons del-lecture-btn" style="color:red">delete</i>
                  <input type="hidden" name="section_sub_number" value="{{ $section->sub_number }}">
                </div>
              </div>
            </form>

            {{--  <div class="mar-left-25 mar-top-25">  --}}
              {{--  ADD LECTURE CONTENT  --}}
              @if ($lecture->content_type == 'VDO')
                <span class="add-vdo-btn bold w20">เปลี่ยนวีดีโอ</span>
                <span class="add-pdf-btn w20">แทนที่ด้วยสไลด์</span>
                <span class="add-txt-btn w20">แทนที่ด้วยบทความ</span>
              @elseif ($lecture->content_type == 'PDF')
                <span class="add-pdf-btn bold w20">เปลี่ยนสไลด์</span>
                <span class="add-vdo-btn w20">แทนที่ด้วยวีดีโอ</span>
                <span class="add-txt-btn w20">แทนที่ด้วยบทความ</span>
              @elseif ($lecture->content_type == 'TXT')
                <span class="add-txt-btn bold w20">แก้ไขบทความ</span>
                <span class="add-vdo-btn w20">แทนที่ด้วยวีดีโอ</span>
                <span class="add-pdf-btn w20">แทนที่ด้วยสไลด์</span>
              @else
                <span class="add-vdo-btn w20">เพิ่มวีดีโอ</span>
                <span class="add-pdf-btn w20">เพิ่มสไลด์</span>
                <span class="add-txt-btn w20">เขียนบทความ</span>
              @endif
            {{--  </div>  --}}

            {{--  LECTURE CONTENT  --}}

            {{--  VIDEO  --}}
            <form enctype="multipart/form-data" id="{{ $lecture->id }}" class="lecture-content-vdo hide">
              {{ csrf_field() }}
              <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
              <input type="hidden" name="content_type" value="VDO">
              <div class="center-align mar-top-25 mar-bot-25">อัพโหลดวีดีโอ</div>

              <input type="file" class="vdo btn">
              <input type="button" class="uploader-btn btn" value="อัพโหลด">
              <progress class="progressBar" value="0" max="100" style="width:300px;"></progress>
              <div class="status"></div>
              <div class="loaded_n_total"></div>
              <div class="list"></div>
            </form>

            {{--  SLIDE  --}}
            <form enctype="multipart/form-data" id="{{ $lecture->id }}" class="lecture-content-pdf hide">
              {{ csrf_field() }}
              <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
              <input type="hidden" name="content_type" value="PDF">
              <div class="center-align mar-top-25 mar-bot-25">อัพโหลดสไลด์</div>

              <input type="file" class="pdf btn">
              <input type="button" class="uploader-btn btn" value="อัพโหลด">
              <progress class="progressBar" value="0" max="100" style="width:300px;"></progress>
              <div class="status"></div>
              <div class="loaded_n_total"></div>
              <div class="list"></div>
            </form>

            {{--  TEXT  --}}
            <form method="POST" id="{{ $lecture->id }}" class="lecture-content-txt hide">
              {{ csrf_field() }}
              <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
              <input type="hidden" name="content_type" value="TXT">
              <div class="center-align mar-top-25">อัพโหลดบทความ</div>
              
              <div class="input-field col s12">
                <textarea name="lecture_text"
                  class="materialize-textarea" style="margin-bottom:0;">{{ $lecture->content_text }}</textarea>
                <label class="active" for="lecture_text">บทความ</label>
              </div>

              <div class="center-align">
                <div class="btn save-lecture-text-btn mar-top-25">บันทึก</div>
              </div>
            </form>
          </div>

          <div class="divider mar-top-25 mar-bot-25"></div>
        @endforeach

        {{--  ADD LECTURE  --}}
        <div class="lecture-content mar-bot-25 mar-top-25"></div>
        <a class="add-lecture btn col offset-s5 mar-bot-25 mar-top-25">
          <i class="material-icons left">note_add</i>
          เพิ่มบทเรียน
        </a>
        <input type="hidden" name="section_sub_number" value="{{ $section->sub_number }}">
      </fieldset>
       
    @endforeach
    
    {{--  ADD SECTION  --}}
    <div class="section-content"></div>
    
    <div class="center-align mar-bot-25">
      <a class="btn-large add-section btn mar-top-25">
        <i class="material-icons large left">library_add</i>
        เพิ่มหัวข้อบทเรียน  
      </a>
    </div>
   
    {{--  ==========================================================================  --}}
    {{--  ==========================================================================  --}}

  </div>

  {{--  AJAX REQUEST  --}}
  <script type="text/javascript">
    $(document).ready(function() {

      // DELETE SECTION
      $(document).on('click', '.del-sec-btn', function(e) {
        var form = $(this).parents("form");
        form.find("input[name='_method']").val('DELETE');

        ajaxFormRequest(form, function(result){
          if (result !== false) location.reload();
        }, {"method":"DELETE", "action":`{{ url('/') }}/course/section` });
      });

      // SAVE SECTION
      $(document).on('click', '.save-sec-btn', function(e) {
        var form = $(this).parents("form");
        form.find("input[name='_method']").val('POST');

        ajaxFormRequest(form, function(result){
          if (result !== false) location.reload();
        }, {"method":"POST", "action":`{{ url('/') }}/course/section` });
      });

      // DELETE LECTURE
      $(document).on('click', '.del-lecture-btn', function(e) {
        var form = $(this).parents("form");
        form.find("input[name='_method']").val('DELETE');

        ajaxFormRequest(form, function(result){
          if (result !== false) location.reload();
        }, {"method":"DELETE", "action":`{{ url('/') }}/course/lecture` });
      });

      // SAVE LECTURE
      $(document).on('click', '.save-lecture-btn', function(e) {
        var form = $(this).parents("form");
        form.find("input[name='_method']").val('POST');

        ajaxFormRequest(form, function(result){
          if (result !== false) location.reload();
        }, {"method":"POST", "action":`{{ url('/') }}/course/lecture` });
      });

      // SAVE LECTURE TEXT CONTENT
      $(document).on('click', '.save-lecture-text-btn', function(e) {
        var form = $(this).parents("form");
        form.find("input[name='_method']").val('POST');

        ajaxFormRequest(form, function(result){
          if (result !== false) location.reload();
        }, {"method":"POST", "action":`{{ url('/') }}/course/lecture-txt` });
      });
    
    });
  </script>

  {{--  FILE AJAX REQUEST  --}}
  <script>
    $(document).on('click','.uploader-btn', function(e) {
      var file =  ($(this).prev())[0].files[0];
      var _token = $("input[name='_token']").val();
      var lecture_id = $(this).parents('form').find("input[name='lecture_id']").val();
      var form_id = '#'+$(this).parents('form').attr('id');
      var method = 'POST';
      var content_type = $(this).siblings("[name='content_type']").val();

      if (content_type == 'VDO')
        var action = "{{ url('/') }}/course/lecture-vdo";
      else if (content_type == 'PDF')
        var action = "{{ url('/') }}/course/lecture-pdf";

      var formdata = new FormData();
      formdata.append("file", file);
      formdata.append("_token", _token);
      formdata.append("lecture_id", lecture_id);
      
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", function(event, dummy = form_id) {
        var percent = (event.loaded / event.total) * 100;

        $('form'+dummy).find('.loaded_n_total').html('อัพโหลดไฟล์ :'+ 
        Number(event.loaded/1048576).toFixed(2) +
        'MB / '+ Number(event.total/1048576).toFixed(2)+'MB');

        $('form'+dummy).find(".progressBar").val(Math.round(percent));
        $('form'+dummy).find(".status").html(Math.round(percent)+"% อยู่ระหว่างการอัพโหลด... กรุณารอสักครู่");
      }, false);

      ajax.addEventListener("load", function(event, dummy = form_id) {
        $('form'+dummy).find('.status').html(event.target.responseText);
        $('form'+dummy).find('.progressBar').val(0);
      }, false);

      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open(method, action);
      ajax.send(formdata);
    });

    // ERROR
    function errorHandler(event){
      alert('upload error');
    }

    // ABORT
    function abortHandler(event){
      alert('upload abort');
    }
  </script>

  {{--  FILE INFO READER  --}}
  <script>
    // READER
    function fileReader(evt) {
      var files = evt.target.files;
      var output = [];
      for (var i = 0, f; f = files[i]; i++) {
        output.push(
          '<li><strong>', 
          f.name, 
          '</strong> (', 
          f.type || 'n/a',
           ') - ',
          Number(f.size/1048576).toFixed(2), 
          ' MB, แก้ไขครั้งล่าสุดเมื่อ: ',
          f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
          '</li>'
        );
      }

      return output;
    }

    // VDO
    $(document).on('change','.vdo', function(evt) {
      var output = fileReader(evt);
      $(this).siblings('.list').html('<ul>' + output.join('') + '</ul>');
    });

    // PDF
    $(document).on('change','.pdf', function(evt) {
      var output = fileReader(evt);
      $(this).siblings('.list').html('<ul>' + output.join('') + '</ul>');
    });
  </script>

  {{--  ==========================================================================  --}}
  {{--  ==========================================================================  --}}

  {{--  JS FUNCTIONS  --}}
  <script type="text/javascript">
    $(document).ready(function() {

      // LECTURE CONTENT TOGGLER
      function toggleLectureContent(element) {
        if (element.main.hasClass('hide'))
          element.main.toggleClass('hide');
        if (! element.sub1.hasClass('hide'))
          element.sub1.toggleClass('hide')
        if (! element.sub2.hasClass('hide'))
          element.sub2.toggleClass('hide')
      }

      // DISPLAY VDO UPLOADER
      $(document).on('click','.add-vdo-btn', function(e) {
        toggleLectureContent({
          "main": $(this).siblings('form.lecture-content-vdo'),
          "sub1": $(this).siblings('form.lecture-content-pdf'),
          "sub2": $(this).siblings('form.lecture-content-txt')
        });
      });

      // DISPLAY SLIDE UPLOADER
      $(document).on('click','.add-pdf-btn', function(e) {
        toggleLectureContent({
          "main": $(this).siblings('form.lecture-content-pdf'),
          "sub1": $(this).siblings('form.lecture-content-vdo'),
          "sub2": $(this).siblings('form.lecture-content-txt')
        });
      });

      // DISPLAY TEXT LECTURE UPLOADER
      $(document).on('click','.add-txt-btn', function(e) {
        toggleLectureContent({
          "main": $(this).siblings('form.lecture-content-txt'),
          "sub1": $(this).siblings('form.lecture-content-vdo'),
          "sub2": $(this).siblings('form.lecture-content-pdf')
        });
      });

      @if ($data->disable == true)
        $('.btn').toggleClass('disabled');
        $('.save-lecture-btn').toggleClass('grey-text');
        $('.del-lecture-btn').toggleClass('grey-text');
      @endif

      // RADIO BUTTON CHECK
      $(document).on('click','.radio-btn', function(e) {
        $(this).prev().prop("checked", true);
      });

      // HIDE/SHOW SECTION
      $(".section-toggle").click( function(e){
        $(this).next("fieldset").slideToggle();
      });

      // ADD SECTION
      $(".add-section").on("click", function(e) {
        $('.section-content').append(`
          <fieldset>
            <legend>บทเรียน</legend>
            <form method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method">
              <input type="hidden" name="course_id" value="{{ $data->id }}">

              <div class="input-field col s12">
                <input name="title" type="text" data-length="50"
                  class="validate" style="margin-bottom:0;">
                <label class="active" for="title">ชื่อหัวข้อ</label>
              </div>

              <div class="input-field col s12">
                <input name="objective" type="text" data-length="50"
                  class="validate" style="margin-bottom:0;">
                <label class="active" for="objective">จุดมุ่งหมาย</label>
              </div>

              <div class="center-align">
                <div class="btn save-sec-btn teal mar-top-25 mar-bot-25">บันทึก</div>
                <div class="btn del-sec-btn red mar-top-25 mar-bot-25">ลบทิ้ง</div>
              </div>
            </form>
          </fieldset>
        `);
      });

      // ADD LECTURE
      $(".add-lecture").on("click", function(e) {
        var section_sub_number = $(this).next().val();
        $(this).prev().append(`
           <form method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method">
            <input type="hidden" name="course_id" value="{{ $data->id }}">
            
            <div style="display:flex;">
              <div class="input-field col s6">
                <input name="title" type="text" data-length="50"
                  class="validate" style="margin-bottom:0;">
                <label class="active" for="title">ชื่อบทเรียน</label>
              </div>

              <div class="col s6 mar-top-10">
                <div style="color: #888">
                  ประเภทบทเรียน :
                </div>

                <input name="status" type="radio" value="FREE">
                <label class="radio-btn">ดูฟรี</label>

                <input name="status" type="radio" value="LOCKED" checked="checked">
                <label class="radio-btn">ล้อค</label>

                <i class="material-icons save-lecture-btn mar-left-25" style="color:teal">save</i>
                <i class="material-icons del-lecture-btn" style="color:red">delete</i>
                <input type="hidden" name="section_sub_number" value="`+ section_sub_number +`">
              </div>
            </div>
          </form>
        `);
      });

    });
  </script>

@endsection