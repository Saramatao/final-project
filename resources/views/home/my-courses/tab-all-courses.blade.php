<div id="test1" class="col s12" style="min-height:400px;">

  {{--  <div class="col s3">
    <div class="input-field">
      <select>
        <option value="0" selected>การซื้อล่าสุด</option>
        <option value="1">ตามลำดับชื่อ หน้า-หลัง</option>
        <option value="2">ตามลำดับชื่อ หลัง-หน้า</option>
      </select>
      <label>จัดเรียง</label>
    </div>
  </div>

  <div class="col s9">

    <div class="col s3">
      <div class="input-field">
        <select>
          <option value="" disabled selected>หมวดหมู่</option>
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
        </select>
        <label>ตัวกรอง</label>
      </div>
    </div>

    <div class="col s3">
      <div class="input-field">
        <select>
          <option value="" disabled selected>ความคืบหน้า</option>
          <option value="1">กำลังเรียนอยู่</option>
          <option value="2">ยังไม่ได้เริ่ม</option>
        </select>
      </div>
    </div>

    <div class="col s3">
      <div class="input-field">
        <select>
          <option value="" disabled selected>ผู้สอน</option>
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
        </select>
      </div>
    </div>

    <div class="col s3 valign-wrapper" style="height:85px;">
      <a class="waves-effect waves-light btn">Reset</a>
    </div>  --}}
    
  {{--  </div>  --}}
  
  {{--  COURSE CARD  --}}
  <div class="col s12" style="display:flex; justify-content: center">
    @foreach ($data['myCourse'] as $data)
      <div class="card card-box hoverable waves-effect">
        <a href="{{ url('/') }}/learn/{{ $data->slug }}/dashboard">
          <div class="card-image">
            <img src="{{ url('/') }}/{{ $data->cover_image }}" style="height:135px;"> 
          
            {{--  <div class="btn-floating halfway-fab waves-effect waves-light edit-collectiondetail-modal-trigger" 
              style="margin-bottom:108px; margin-right:-17px;">
              <i class="material-icons">close</i>
            </div>  --}}

          </div>

          <div class="card-content custom-card-content" style="padding:0 0 0 0;">
            <div class="card-course-title">
              {{ $data->title }}
            </div>
            <div class="card-teacher-title">
              {{ $data->user->name }} {{ $data->user->last_name }}
            </div>
            <div class="progress" style="margin-bottom: 0px; width:90%;">
              <div class="determinate" style="width: {{ $data->learn_progress }}%"></div>
            </div>
            <span style="color:teal;">ความคืบหน้า {{ $data->learn_progress }}%</span>
          </div>

          <div class="card-action" style="padding:0 0 0 0;"> 
            <div class="star-rating" style="margin-left:17px; margin-top:5px;">
              @if(count($data->review) > 0)
                @for ($i = 0; $i < 5; $i++)
                  @if ($data->review[0]->rating - $i >= 1 )
                    <i class="material-icons" style="font-size:21px;">star</i>
                  @elseif ($data->review[0]->rating - $i >= 0.5)
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

  {{--  <ul class="pagination center-align">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
  </ul>  --}}

</div>

{{--  MODAL GENERATOR  --}}
<script type="text/javascript">
  $(document).ready(function() {
    

  });

</script>