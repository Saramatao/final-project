<div class="col s12 teal" style="height:135px;">
  <div class="pc-container auto-margin h100">
    <div style="font-size:2em; line-height:135px;">
      ค้นหาคอร์สเรียน

      <form method="POST" action="{{ url('/') }}/search" style="display:inline;">
        {{ csrf_field() }}

        <div class="input-field inline" style="color:white; margin-top: -20px;">
          <input type="text" name="searchTxt">
        </div>

        <button type="submit" class="btn" style="margin-left: 20px;">ค้นหา</button>
      </form>
    </div>
  </div>
</div>

<div style="padding-left:15px; min-height: 400px;" class="pc-container auto-margin col">
  
  @if (count ($courses) > 0)
    @foreach ($courses as $course)
      <div class="card card-box hoverable waves-effect">
        <a href="/view/{{ $course->slug }}">
          <div class="card-image">
            <img src="{{ url('/') }}/{{ $course->cover_image }}" style="height:135px;"> 
          </div>

          <div class="card-content custom-card-content" style="padding:0 0 0 0;">
            <div class="card-course-title truncate">
              {{ $course->title }}
            </div>
            <div class="card-teacher-title truncate">
              {{ $course->user->name }} {{ $course->user->last_name }}
            </div>

            <div class="star-rating">
              @for ($i = 0; $i < 5; $i++)
                @if ($course->average_rating - $i >= 1 )
                  <i class="material-icons" style="font-size:21px;">star</i>
                @elseif ($course->average_rating - $i >= 0.5)
                  <i class="material-icons" style="font-size:21px;">star_half</i>
                @else
                  <i class="material-icons" style="font-size:21px;">star_border</i>
                @endif
              @endfor 
            </div>
          </div>

          <div class="card-action" style="padding:0 0 0 0;"> 
            <div class="card-footer-price" style="margin-right:5px;">
              @if ($course['discounted_price'] == null)
                ฿{{ $course->price }}
              @else
                <span class="price-line" style="font-size:0.8em">
                  ฿{{ $course->price }}
                </span>
                ฿{{ $course->discounted_price }}
              @endif
            </div>
          </div>
        </a>
      </div>
        
    @endforeach
  @else
    <div style="padding-top: 25px; font-size: 1.5em;">
      ไม่พบคอร์สเรียนที่ค้นหา
    </div>
  @endif

</div>
