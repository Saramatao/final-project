<div id="test2" class="col s12" style="min-height:400px;">

  {{--  CREATE COLLECTION MODAL TRIGGER  --}}
  <div href="#modal1" class="modal-trigger create-collection-modal-trigger center-align"
    style="margin-top:25px; margin-bottom:25px;">
    <div class="btn">
      สร้างหมวดหมู่คอร์สเรียน
    </div>
  </div>

  @foreach ($data['myCollection'] as $collection)
    <div class="col s12 flex" style="font-size:1.5em;">
      <div style="margin-right:25px;">{{ $collection->name }}</div>

      {{--  EDIT COLLECTION MODAL TRIGGER  --}}
      <div href="#modal1" class="modal-trigger edit-collection-modal-trigger">
        <i class="material-icons" style="font-size:1.5em;">edit</i>
        <input type="hidden" name="collection_id" value="{{ $collection->id }}">
        <input type="hidden" name="collection_name" value="{{ $collection->name }}">
        <input type="hidden" name="note" value="{{ $collection->note }}">
      </div>

      {{--  EDIT DETAIL COURSE  --}}
      <div href="#modal1" class="edit-collection-detail-modal-trigger">
        <i class="material-icons" style="font-size:1.5em;">library_add</i>
        <input type="hidden" name="collection_id" value="{{ $collection->id }}">
        <input type="hidden" name="collection_name" value="{{ $collection->name }}">
      </div>

      {{--  DELETE COLLECTION  --}}
      <div>
        <form role="form" method="POST">
          {{ method_field('DELETE') }}
          {{ csrf_field() }}
          <input type="hidden" name="collection_id" value="{{ $collection->id }}">

          <i class="material-icons delete-collection-btn" style="font-size:1.5em;">delete</i>
        </form>
      </div>
    </div>

    <div class="col s12" style="color: #777">
      {{ $collection->note }}
    </div>

    {{--  COURSE CARD  --}}
    <div class="col s12" style="display:flex; justify-content: center">
      @foreach ($collection->collectiondetail as $detail)
        <div class="card card-box hoverable waves-effect">
          <a href="{{ url('/') }}/learn/{{ $detail->course->slug }}/dashboard">
            <div class="card-image">
              <img src="{{ url('/') }}/{{ $detail->course->cover_image }}" style="height:135px;"> 
              
              {{--  DELETE DETAIL COURSE  --}}
              <form role="form" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input type="hidden" name="collection_id" value="{{ $collection->id }}">
                <input type="hidden" name="course_id" value="{{ $detail->course->id }}">

                <div class="btn-floating halfway-fab waves-effect waves-light 
                  delete-detail-btn" style="margin-bottom:108px; margin-right:-17px;">
                  <i class="material-icons">close</i>
                </div>
              </form>
            </div>

            <div class="card-content custom-card-content" style="padding:0 0 0 0;">

              <div class="card-course-title">
                {{ $detail->course->title }}
              </div>
              <div class="card-teacher-title">
                {{ $detail->course->user->name }} {{ $detail->course->user->last_name }}
              </div>
              <div class="progress" style="margin-bottom: 0px; width:85%;">
                <div class="determinate" style="width: {{ $detail->course->learn_progress }}%"></div>
              </div>
              <span style="color:teal;">ความคืบหน้า {{ $detail->course->learn_progress }}%</span>
            </div>

            <div class="card-action" style="padding:0 0 0 0;"> 
              <div class="star-rating" style="margin-left:17px; margin-top:5px;">
                @if(count($detail->course->review) > 0)
                  @for ($i = 0; $i < 5; $i++)
                    @if ($detail->course->review[0]->rating - $i >= 1 )
                      <i class="material-icons" style="font-size:21px;">star</i>
                    @elseif ($detail->course->review[0]->rating - $i >= 0.5)
                      <i class="material-icons" style="font-size:21px;">star_half</i>
                    @else
                      <i class="material-icons" style="font-size:21px;">star_border</i>
                    @endif
                  @endfor 
                @else
                  <div class="flex">
                    <i class="material-icons" style="font-size:21px;">edit</i>
                    <div style="margin-left:5px;">เขียนคำวิจารณ์</div>
                  </div>
                  {{--  ยังไม่ได้ให้คะแนน  --}}
                @endif
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

  @endforeach

</div>

{{--  MODAL BOX  --}}
<div id="modal1" class="modal">
  <div class="modal-content">
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">ปิดหน้าต่าง</a>
  </div>
</div>

{{--  AJAX REQUEST  --}}
<script type="text/javascript">
  $(document).ready(function() {
    
    // CREATE COLLECTION
    $(document).on('click', '.create-collection-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('POST');
      $('#modal1').modal('close');

      ajaxFormRequest(form, null, {
        "method":"POST", 
        "action":`{{ url('/') }}/collection` 
      });
    });

    // EDIT COLLECTION
    $(document).on('click', '.edit-collection-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('PATCH');
      $('#modal1').modal('close');

      ajaxFormRequest(form, null, {
        "method":"PATCH", 
        "action":`{{ url('/') }}/collection` 
      });
    });

    // DELETE COLLECTION
    $(document).on('click', '.delete-collection-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('DELETE');

      ajaxFormRequest(form, null, {
        "method":"DELETE", 
        "action":`{{ url('/') }}/collection` 
      });
    });

    // DELETE COLLECTION DETAIL
    $(document).on('click', '.delete-detail-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      form.find("input[name='_method']").val('DELETE');

      ajaxFormRequest(form, null, {
        "method":"DELETE", 
        "action":`{{ url('/') }}/collectiondetail` 
      });
    });

    // EDIT COLLECTION DETAIL
    $(document).on('click', '.edit-collection-detail-btn', function(e) {
      e.preventDefault();
      var form = $(this).parents("form");
      $(this).toggleClass('light-grey');

      ajaxFormRequest(form, null, {
        "method":"POST", 
        "action":`{{ url('/') }}/collectiondetail` 
      });
    });


  });
</script>

{{--  MODAL GENERATOR  --}}
<script type="text/javascript">
  $(document).ready(function() {
    
    // CREATE COLLECTION MODAL
    $(".create-collection-modal-trigger").on("click", function(e) {

      $('.modal-content').html(`
        <h4 class="center-align" style="margin-bottom:25px;">สร้างหมวดหมู่คอร์สเรียน</h4>

        <form role="form" method="POST">
          {{ method_field('POST') }}
          {{ csrf_field() }}

          <div class="input-field col s12">
            <input name="collection_name" type="text" data-length="50"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="collection_name">ชื่อหมวดหมู่</label>
          </div>

          <div class="input-field col s12">
            <input name="note" type="text" data-length="50"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="note">รายละเอียด</label>
          </div>
          
          <div class="center-align">
            <button type="submit" class="btn btn-submit create-collection-btn"
              style="margin-top:25px;">
              บันทึก
            </button> 
          </div>
        </form>
      `);
      
      $('#modal1').modal('open');
    });

    // EDIT COLLECTION MODAL
    $(".edit-collection-modal-trigger").on("click", function(e) {
      var collection_id = $(this).find('input[name="collection_id"]').val();
      var collection_name = $(this).find('input[name="collection_name"]').val();
      var note = $(this).find('input[name="note"]').val();

      $('.modal-content').html(`
        <h4 class="center-align" style="margin-bottom:25px;">แก้ไขหมวดหมู่คอร์สเรียน</h4>

        <form role="form" method="POST">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}

          <input type="hidden" name="collection_id" value="`+ collection_id +`">

          <div class="input-field col s12">
            <input name="collection_name" type="text" data-length="50" value="`+ collection_name +`"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="collection_name">ชื่อหมวดหมู่</label>
          </div>

          <div class="input-field col s12">
            <input name="note" type="text" data-length="50" value="`+ note +`"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="note">รายละเอียด</label>
          </div>
          
          <div class="center-align">
            <button type="submit" class="btn btn-submit edit-collection-btn"
              style="margin-top:25px;">
              บันทึก
            </button> 
          </div>
        </form>
      `);
      
      $('#modal1').modal('open');
    });

    // EDIT COLLECTION DETAIL MODAL
    $(document).on('click', '.edit-collection-detail-modal-trigger', function(e) {
      e.preventDefault();
      var collection_id = $(this).find("input[name='collection_id']").val();

      $('#modal1').modal('open');

      $('.modal-content').html(`
        <div class="center-align" style="margin-top:10%;">
          <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-green-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
      `);

      $.get( "{{ url('/') }}/collection/"+ collection_id + "/detail", function( data ) {
        $('.modal-content').html(`
          <h4 class="center-align" style="margin-bottom:25px;">กำหนดหมวดหมู่คอร์สเรียน</h4>
        `);

        data.forEach(function (course) {
          if( course.collectiondetail.length > 0)
            $('.modal-content').append(`
              <form role="form" method="POST" action="{{ url('/') }}/collectiondetail">
                {{ csrf_field() }}
                <input type="hidden" name="collection_id" value="` + collection_id + `">
                <input type="hidden" name="course_id" value="` + course.id + `">

                <div class="edit-collection-detail-btn col w40 flex z-depth-2 hoverable">` +
                  `<img src="{{ url('/') }}/`+ course.cover_image +`" alt="`+ course.title +`"
                    style="width:100px; height:50px; margin-right:5px;">` + course.title +   
                `</div>
              </form>
            `);
          else
            $('.modal-content').append(`
              <form role="form" method="POST" action="{{ url('/') }}/collectiondetail">
                {{ csrf_field() }}
                <input type="hidden" name="collection_id" value="` + collection_id + `">
                <input type="hidden" name="course_id" value="` + course.id + `">
               
                <div class="edit-collection-detail-btn col w40 flex z-depth-2 hoverable light-grey">` +
                  `<img src="{{ url('/') }}/`+ course.cover_image +`" alt="`+ course.title +`"
                    style="width:100px; height:50px; margin-right:5px;">` + course.title +   
                `</div>
              </form>
            `);
        });

        $('#modal1').modal('open');
      });
    });

  });

</script>