<div class="z-depth-6" style="height:250px; margin-bottom:25px;">

  <div style="min-height: 250px; width:100%; position: absolute; z-index:-1; 
    background: url('{{ url('/') }}/{{ $data->cover_image }}'); filter: blur(10px);"></div>

  <div class="row pc-container"> 
    <div class="col s12">
      
      <div class="col s8" style="max-height: 250px; background-color: rgba(255,255,255,0.4); 
        border-radius:5px; margin-top:12px;"> 
        <div style="font-size: 2.5em;">
          {{ $data->title }}
        </div>
        <div style="font-size: 2em; margin-bottom: 5px;">
          {{ $data->subtitle }}
        </div>

        @for ($i = 0; $i < 5; $i++)
          @if ($data->average_rating - $i >= 1 )
            <i class="material-icons" style="font-size:21px;">star</i>
          @elseif ($data->average_rating - $i >= 0.5)
            <i class="material-icons" style="font-size:21px;">star_half</i>
          @else
            <i class="material-icons" style="font-size:21px;">star_border</i>
          @endif
        @endfor 

        {{ $data->count_enrollment }} 
        <div>การลงทะเบียน</div>
        <div>โดย {{ $data->user->name }} {{ $data->user->last_name }}</div>
        <div>ถูกสร้างเมื่อ {{ $data->created_at->format('d M Y') }}</div>
        <div>ภาษา {{ $data->language }}</div>

      </div>

      <div class="col s4"> 
        <div class="z-depth-3" style="margin-left: 25px; margin-top:10px; position:fixed;
          width:280px; background-color: #fff; border-radius:5px; overflow:hidden;">

          <img src="{{ url('/') }}/{{ $data->cover_image }}" style="height:175px; width:100%;"> 
          {{--  <div id="video-container">
            <video id="video" width="280" height="150">
              <source src="{{ asset('images') }}/{{ $data->promote_vdo }}?r={{ rand(1,2) }}" type="video/mp4">
              <span> Your browser doesn't support HTML5 video. </span>
            </video>
            <div id="video-controls" style="display:none;">
              <button type="button" id="play-pause" class="play">Play</button>
              <input type="range" id="seek-bar" value="0">
              <button type="button" id="mute">Mute</button>
              <input type="range" id="volume-bar" min="0" max="1" step="0.1" value="1">
              <button type="button" id="full-screen">Full-Screen</button>
            </div>
          </div>  --}}
          
          <div style="margin-left:10px; margin-bottom:10px; margin-top:10px;">
            @if ($data->promotion === null)
              <span style="margin-left:10px; font-size: 2.5em;">
                ฿{{ $data->price }}
              </span>
            @else
              <span class="price-line">
                ฿{{ $data->price }}
              </span>
              <span style="margin-left:10px; font-size: 2.5em;">
                ฿{{ $data->discounted_price }}
              </span>
            @endif
          </div>

          @if (! Auth::guest())
          <div class="center-align" style="margin-bottom:7px;">
          
            {{--  ADD WISHLIST  --}}
          @if (! $data->isWishlisted)
            <form action="{{ url('/') }}/wishlist" method="POST">
              {{ csrf_field() }}

              <input type="hidden" name="course_id" value="{{ $data->id }}">
              
              <button type="submit" class="waves-effect waves-dark btn w80 add-cart-btn">
                เพิ่มในรายการโปรด
              </button>
            </form>
          @endif

            {{--  DELETE WISHLIST  --}}
          @if ($data->isWishlisted)
            <form action="{{ url('/') }}/wishlist" method="POST">
              {{ method_field('delete') }}
              {{ csrf_field() }}

              <input type="hidden" name="course_id" value="{{ $data->id }}">
              
              <button type="submit" class="waves-effect waves-dark btn w80 add-cart-btn">
                ลบออกจากรายการโปรด
              </button>
            </form>
          @endif

          </div>
          @endif

          <div class="center-align">
            <form action="{{ url('/') }}/cart" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="course_id" value="{{ $data->id }}">

              <button type="submit" class="waves-effect waves-light btn w80 add-cart-btn">
                หยิบลงตรงกร้า
              </button>
            </form>
          </div>

          <ul style="margin-left:10px; margin-bottom:10px; margin-top:10px;">

            <li>
              ฟีตเจอร์:
            </li>
            <li>
              <i class="material-icons">check</i>
              10 quality hours video
            </li>
            <li>
              <i class="material-icons">attachment</i>
              15 Supplemental Resources
            </li>
            <li>
              <i class="material-icons">check</i>
              Full lifetime access
            </li>
            {{--  <li class="center-align">
              <a class="waves-effect waves-light btn green">ใส่โค้ดคูปอง</a>
            </li>  --}}

          </ul>

        </div> 
      </div>
    </div>
  </div> 
</div> 

