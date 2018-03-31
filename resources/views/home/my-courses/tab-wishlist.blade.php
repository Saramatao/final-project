<div id="wishlist" class="col s12" style="min-height:400px;">

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
    </div>
    
  </div>  --}}

  <div class="col s12" style="display:flex; justify-content: center">
    @foreach ($data['myWishlist'] as $data)
      <div class="card card-box hoverable waves-effect">
        <a href="{{ url('/') }}/view/{{ $data->slug }}">
          <div class="card-image">
            <img src="{{ url('/') }}/{{ $data->cover_image }}" style="height:135px;"> 
          </div>

          <div class="card-content custom-card-content" style="padding:0 0 0 0;">
            <div class="card-course-title">
              {{ $data->title }}
            </div>
            <div class="card-teacher-title">
              {{ $data->user->name }} {{ $data->user->last_name }}
            </div>
          </div>

          <div class="star-rating" style="margin-left:17px; margin-top:5px;">
            @if(count($data->review) > 0)
              @for ($i = 0; $i < 5; $i++)
                @if ($data->average_rating - $i >= 1 )
                  <i class="material-icons" style="font-size:21px;">star</i>
                @elseif ($data->average_rating - $i >= 0.5)
                  <i class="material-icons" style="font-size:21px;">star_half</i>
                @else
                  <i class="material-icons" style="font-size:21px;">star_border</i>
                @endif
              @endfor 
            @endif
          </div>

          <div class="card-action" style="padding:0 0 0 0;"> 
            <div class="card-footer-price" style="margin-right:5px;">
              @if ($data->promotion === null)
                ฿{{ $data->price }}
              @else
                <span class="price-line" style="font-size:0.8em">
                  ฿{{ $data->price }}
                </span>
                ฿{{ $data->discounted_price }}
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