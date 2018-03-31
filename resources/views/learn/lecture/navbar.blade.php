<div class="fixed-action-btn horizontal" style="margin-bottom: 25px;">
  <a href="{{ url('/') }}/learn/{{ $slug }}/dashboard" class="btn-floating btn-large red hoverable">
    <i class="large material-icons" style="font-size: 40px;">home</i>
  </a>
  <ul>
    <li>
      <a style="margin-top: -5px;" class="btn-floating hoverable lime modal-trigger" href="#modal1">
      <i class="large material-icons">bookmark</i></a>
    </li>
    <li>
      <a style="margin-top: -5px;" class="btn-floating hoverable">
      <i class="large material-icons">border_color</i></a>
    </li>
    <li>
      <a href="{{ url('/') }}/learn/{{ $slug }}/dashboard#qa" style="margin-top: -5px;" class="btn-floating yellow darken-1 hoverable">
      <i class="material-icons">question_answer</i></a>
    </li>
    <li>
      <a style="margin-top: -5px;" class="btn-floating blue button-collapse hoverable" data-activates="side-menu" style="display:inline-block;">
      <i class="material-icons">view_list</i></a>
    </li>
   
    @if ($lecture_ids[0] != $data->id)
      @foreach ($lecture_ids as $index=>$id)
        @if ($id == $data->id)

          <li>
            <a href="{{ url('/') }}/learn/{{ $slug }}/lecture/{{ $lecture_ids[$index-1] }}" style="margin-top: -5px;" class="btn-floating green hoverable">
            <i class="material-icons">keyboard_arrow_left</i></a>
          </li>

        @endif
      @endforeach
    @endif

    @if ( array_reverse($lecture_ids)[0] != $data->id)
      @foreach ($lecture_ids as $index=>$id)
        @if ($id == $data->id)

          <li>
            <a href="{{ url('/') }}/learn/{{ $slug }}/lecture/{{ $lecture_ids[$index+1] }}" style="margin-top: -5px;" class="btn-floating green hoverable">
            <i class="material-icons">keyboard_arrow_right</i></a>
          </li>

        @endif
      @endforeach
    @endif

  </ul>
</div>

<ul class="side-nav collapsible" id="side-menu" data-collapsible="expandable" style="width:50%;">

  @foreach ($sections as $section)
    <li>
      <div class="collapsible-header">
        <i class="material-icons">expand_more</i>
        <div style="width:1000px;"> {{ $section->title }} </div>
      </div>
      <div class="collapsible-body" style="padding:0;">
        <ul class="collection blue">
          @foreach ($section->lecture as $lecture)
            <a href="{{ url('/') }}/learn/{{ $slug }}/lecture/{{ $lecture->id }}">
              <li style="padding-left: 2em;" class="collection-item">
                <span>{{ $lecture->title }}</span>
                <span class="right">{{ $lecture->content_type }}</span>
              </li>
            </a>
          @endforeach
        </ul>
      </div>
    </li>
  @endforeach

</ul>

 {{--  Bookmarks Modal Box  --}}
<div id="modal1" class="modal">
  <div class="modal-content center-align">
    <h4>บุ๊คมาร์ค</h4>

    <form id="bookmarks-form" action="{{ url('/') }}/bookmarks" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
      <input type="hidden" name="lecture_id" value="{{ $data->id }}">

      <div class="input-field col s12">
        <label class="active" for="note">ข้อความ</label>
        <textarea name="note" class="materialize-textarea validate" data-length="500"></textarea>
      </div>

      <div class="center-align">
        <button type="submit" id="submit-bookmarks-btn" class="btn btn-submit mar-top-25">
          บันทึก
        </button> 
      </div>
    </form>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">ปิดหน้าต่าง</a>
  </div>
</div>

{{--  AJAX  --}}
<script>
  $(document).ready( function() {
    var form = $('#bookmarks-form');
    
    // Get Bookmarks
    ajaxFormRequest(form, function(result) {
      $("textarea[name='note']").val(result.note);
      $("textarea[name='note']").focus();
    }, {
      method: "GET",
      action: "{{ url('/') }}/bookmarks"
    });

    // Create / Update Bookmarks
    $('#submit-bookmarks-btn').on('click', function(e) {
      e.preventDefault()

      ajaxFormRequest(form, function(result) {
        console.log(result)
      }, {
        method: "POST",
        action: "{{ url('/') }}/bookmarks"
      });
    });
  });
</script>