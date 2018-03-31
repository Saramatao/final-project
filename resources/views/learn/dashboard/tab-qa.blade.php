<div id="qa" class="card-panel">

  {{--  CREATE QUESTION  --}}
  <div>
    สร้างคำถามใหม่
  </div>
  <div class="w100 auto-margin">
    
    <form role="form" class="form_question" method="POST">
      {{ csrf_field() }}
      <input name="_method" type="hidden">
      <input name="slug" type="hidden" value="{{ $data->slug }}">

      <div class="input-field col s12">
        <input name="title" type="text" data-length="50"
          class="validate" style="margin-bottom:0;">
        <label class="active" for="title">หัวข้อคำถาม</label>
      </div>

      <div class="input-field col s12">
        <textarea name="question" data-length="1000"
          class="materialize-textarea" style="margin-bottom:0;"></textarea>
        <label class="active" for="question">เนื้อหาคำถาม</label>
      </div>
      
      <div class="center-align" style="margin-top:25px;">
        <button type="submit" class="btn btn-submit create-question-btn">
          ยืนยัน
        </button> 
      </div>

    </form>
  </div>

  {{--  Q&A SECTION   --}}
  <div style="margin-bottom:25px; margin-top:25px;">
    คำถามจากนักเรียน
  </div>

  <ul class="collapsible popout" data-collapsible="expandable">
    @foreach ($data->question as $question)
      <li>
        <div class="collapsible-header">
          <div style="display:flex; justify-content:center; width:1500px;">
            <div>
              <img src="{{ url('/') }}/{{ $question->user->student->photo }}" 
                class="circle" style="width:75px; height:75px; margin-top:8px;">
            </div>
            <div style="width:750px; margin-left:25px;">
              <div class="truncate">
                {{ $question->user->name }} {{ $question->user->last_name }}
              </div>
              <div>
                {{ $question->created_at->format('d M Y') }}
              </div>
              <div class="truncate bold">
                {{ $question->title }} 
              </div>
              <div class="truncate">
                {{ $question->content }} 
              </div>
            </div>
            <div class="flex">
              @if (Auth::user()->id == $question->student_id)
                {{--  EDIT QUESTION MODAL  --}}
                <div style="margin-left:25px; width:30px;">
                <div href="#modal1" class="modal-trigger question-modal-trigger">
                  <i type="submit" class="material-icons">create</i>
                  <input type="hidden" name="question_id" value="{{ $question->id }}">
                  <input type="hidden" name="title" value="{{ $question->title }}">
                  <input type="hidden" name="question" value="{{ $question->content }}">
                </div>
                </div>

                {{--  DELETE QUESTION  --}}
                <div style="width:25px;">
                <form role="form" class="form_question_delete" method="POST">
                  {{ csrf_field() }}
                  <input name="_method" type="hidden">
                  <input type="hidden" name="question_id" value="{{ $question->id }}">
                  
                  <i type="submit" class="material-icons delete-question-btn">delete</i>
                </form>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
          <ul class="collection">
            <li style="padding-left:100px; padding-right:100px;" class="collection-item">
              <div class="bold">
                {{ $question->title }} 
              </div>
              <div>
                {{ $question->content }} 
              </div>
            </li>

            {{--  ANSWER SECTION  --}}
            @foreach ($question->answer as $answer)
              <li style="padding-left:100px; padding-right:100px;" class="collection-item">
                <div class="flex">
                  <div>
                    <img src="{{ url('/') }}/{{ $answer->user->student->photo }}" 
                      class="circle" style="width:50px; height:50px;">
                  </div>

                  <div style="margin-left:25px;">
                    <div class="flex">
                      <div>
                      {{ $answer->user->name }} {{ $answer->user->last_name }}
                      </div>

                      <div class="flex" style="margin-left:25px;">
                        @if (Auth::user()->id == $answer->student_id)
                          {{--  EDIT ANSWER MODAL  --}}
                          <div class="modal-trigger answer-modal-trigger" href="#modal1">
                            <i type="submit" class="material-icons" style="font-size:1.25em;">create</i>
                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                            <input type="hidden" name="answer" value="{{ $answer->content }}">
                          </div>

                          {{--  DELETE ANSWER  --}}
                          <form role="form" class="form_answer_delete" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method">
                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                            
                            <i type="submit" class="material-icons delete-answer-btn" 
                              style="font-size:1.25em;">delete</i>
                          </form>
                        @endif
                      </div>

                    </div>
                    <div>
                      {{ $answer->created_at->format('d M Y') }}
                    </div>
                    {{ $answer->content }}
                  </div>
                </div>
              </li>
            @endforeach

            {{--  CREATE ANSWER  --}}
            <li class="collection-item">
              <div style="padding-left:100px; padding-right:100px; margin-top:25px;">
                <div>
                  แสดงความคิดเห็น
                </div>
                
                <form role="form" class="form_answer" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method">
                  <input type="hidden" name="question_id" value="{{ $question->id }}">

                  <div class="input-field col s12">
                    <textarea id="answer" name="answer" data-length="1000"
                      class="materialize-textarea" style="margin-bottom:0;"></textarea>
                    <label class="active" for="answer">ความคิดเห็น</label>
                  </div>

                  <div class="center-align" style="margin-top:25px; margin-bottom:25px;">
                    <button type="submit" class="btn btn-submit create-answer-btn">
                      ยืนยัน
                    </button> 
                  </div>
                </form>
              </div>
            </li>

          </ul>
        </div>
      </li>
    @endforeach
  </ul>

  {{--  MODAL BOX  --}}
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      Modal Content
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">ปิดหน้าต่าง</a>
    </div>
  </div>

</div>

{{--  AJAX REQUEST  --}}
<script type="text/javascript">
  $(document).ready(function() {

    var course_url = '{{ url('/')}}/learn/{{ $data->slug }}/dashboard#qa';

    // EDIT QUESTION      
    $(document).on('click', '.edit-question-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('PATCH');
      $('#modal1').modal('close');

      ajaxFormRequest(form, function(result) {
        if (result !== false) window.location.reload();
      }, {
        "method":"PATCH", 
        "action":`{{ url('/') }}/question` 
      });
    });

    // EDIT ANSWER
    $(document).on('click', '.edit-answer-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('PATCH');
      $('#modal1').modal('close');

      ajaxFormRequest(form, function(result) {
        if (result !== false) window.location.reload();
      }, {
        "method":"PATCH", 
        "action":`{{ url('/') }}/answer` 
      });
    });

    // CREATE QUESTION      
    $(document).on('click', '.create-question-btn', function(e) {
      e.preventDefault();   
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('POST');

      ajaxFormRequest(form, function(result) {
        if (result !== false) window.location.reload();
      }, {
        "method":"POST", 
        "action":`{{ url('/') }}/question` 
      });
    });

    // DELETE QUESTION      
    $(document).on('click', '.delete-question-btn', function(e) {
      e.preventDefault();   
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('DELETE');

      ajaxFormRequest(form, function(result) {
        if (result !== false) window.location.reload();
      }, {
        "method":"DELETE", 
        "action":`{{ url('/') }}/question` 
      });
    });

    // CREATE ANSWER  
    $(document).on('click', '.create-answer-btn', function(e) {
      e.preventDefault();   
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('POST');

      ajaxFormRequest(form, function(result) {
        if (result !== false) window.location.reload();
      }, {
        "method":"POST", 
        "action":`{{ url('/') }}/answer` 
      });
    });

    // DELETE ANSWER 
    $(document).on('click', '.delete-answer-btn', function(e) {
      e.preventDefault();   
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('DELETE');

      ajaxFormRequest(form, function(result) {
        if (result !== false) window.location.reload();
      }, {
        "method":"DELETE", 
        "action":`{{ url('/') }}/answer` 
      });
    });

  });
</script>

{{--  MODAL GENERATOR  --}}
<script type="text/javascript">
  $(document).ready(function() {

    // EDIT QUESTION MODAL
    $(".question-modal-trigger").on("click", function(e) {
      var question_id = $(this).find('input[name="question_id"]').val();
      var title = $(this).find('input[name="title"]').val();
      var question = $(this).find('input[name="question"]').val();

      $('.modal-content').html(`
        <h4 class="center-align" style="margin-bottom:25px;">แก้ไขคำถาม</h4>

        <form role="form" class="form_question_edit" method="POST">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}

          <input type="hidden" name="question_id" value="`+ question_id +`">
        
          <div class="input-field col s12">
            <input name="title" type="text" data-length="50" value="`+ title +`"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="title">หัวข้อคำถาม</label>
          </div>

          <div class="input-field col s12">
            <input name="question" type="text" data-length="50" value="`+ question +`"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="question">เนื้อหาคำถาม</label>
          </div>
          
          <div class="center-align">
            <button type="submit" class="btn btn-submit edit-question-btn"
              style="margin-top:25px;">
              บันทึก
            </button> 
          </div>
        </form>
      `);

      $('#modal1').modal('open');

      e.cancelBubble = true;
        if (e.stopPropagation) e.stopPropagation();
    });

    // EDIT ANSWER MODAL
    $(".answer-modal-trigger").on("click", function() {
      var answer_id = $(this).find('input[name="answer_id"]').val();
      var answer = $(this).find('input[name="answer"]').val();

      $('.modal-content').html(`
        <h4 class="center-align" style="margin-bottom:25px;">แก้ไขความคิดเห็น</h4>

        <form role="form" class="form_answer_edit" method="POST">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}

          <input type="hidden" name="answer_id" value="`+ answer_id +`">

          <div class="input-field col s12">
            <textarea id="answer" name="answer" data-length="1000"
              class="materialize-textarea" style="margin-bottom:0;">`
              + answer +
              `</textarea>
            <label class="active" for="answer">ความคิดเห็น</label>
          </div>
          
          <div class="center-align">
            <button type="submit" class="btn btn-submit edit-answer-btn"
              style="margin-top:25px;">
              บันทึก
            </button> 
          </div>
        </form>
      `);
    });

  });
</script>

