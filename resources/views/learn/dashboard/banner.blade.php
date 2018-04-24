<div class="teal" style="height:300px; width:100%; padding-top: 25px;">
  <div class="pc-container" style="height:250px; display:flex; margin-left:auto; margin-right:auto; justify-content: space-between;">

    <div style="min-width:400px;">
      <img src="{{ url('/') }}/{{ $data->cover_image }}" style="width:400px; height:250px;">
    </div>

    <div style="min-width:720px; padding-right:25px;">
      <div style="font-size:2em;">
        {{ $data->title }}
      </div>

      <div style="margin-bottom: 15px;">
        <a href="/learn/{{ $data->slug }}/lecture/{{ $data->section[0]->lecture[0]->id }}" 
          class="waves-effect waves-light btn">เข้าสู่คอร์สเรียน</a>
      </div>

      <div>
        @if ($review)

          @for ($i = 0; $i < 5; $i++)
            @if ($review->rating - $i >= 1 )
              <i class="material-icons" style="font-size:21px; color:gold">star</i>
            @elseif ($review->rating - $i >= 0.5)
              <i class="material-icons" style="font-size:21px; color:gold">star_half</i>
            @else
              <i class="material-icons" style="font-size:21px; color:gold">star_border</i>
            @endif
          @endfor 
          <span class="review-modal-trigger" style="margin-left: 15px; font-size:1.3em; text-decoration:underline;"> 
            แก้ไขคะแนนวิจารณ์ 
          </span>
         
        @else 
          <span class="review-modal-trigger" style="margin-left: 15px; font-size:1.3em; text-decoration:underline;"> 
            เพิ่มคะแนนวิจารณ์ 
          </span>
        @endif
      </div>

      <div>
        <div>
        ความคืบหน้าในการเรียน {{ $data->count_progress }} ใน {{ $data->count_lecture }}
        </div>
        <div class="progress" style="height:25px;">
          <div class="determinate center-align bold" 
            style="width: {{ $data->learn_progress }}%; background-color:yellow;">
            {{ $data->learn_progress }}%
          </div>
        </div>
      </div>

    </div>

  </div>
</div>

{{--  MODAL BOX  --}}
<div id="modal-review" class="modal">
  <div class="modal-content">
    <h4>ให้คะแนนคอร์สเรียน</h4>
      <form method="POST" action="/review">
        {{ csrf_field() }}

        <input type="hidden" name="review_id" value="{{ $review->id or '' }}">
        <input type="hidden" name="course_id" value="{{ $data->id }}">

        <div class="input-field col s12">
          <input id="rating" name="rating" type="number" max="5" min="0" value="{{ $review->rating or 0 }}"
            class="validate" style="margin-bottom:0;">
          <label class="active" for="rating">คะแนน</label>
        </div>

        <div class="input-field col s12">
          <textarea name="comment" data-length="500"
            class="materialize-textarea" style="margin-bottom:0;">{{ $review->comment or '' }}</textarea>
          <label class="active" for="comment">ความคิดเห็น</label>
        </div>
      
        <div class="center-align">
          <button type="submit" class="btn btn-submit"
            style="margin-top:25px;">
            บันทึก
          </button> 
        </div>
      </form>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">
      ปิดหน้าต่าง</a>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $(".review-modal-trigger").on("click", function(e) {
      $('#modal-review').modal('open');
      $('#rating').focus()
    });

  });
</script>
