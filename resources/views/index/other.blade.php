<div style="margin-left:auto; margin-right:auto; padding-left:15px;" class="pc-container">
  
  @if (count ($dataset) > 0)
    @foreach ($dataset as $index=>$data)
      <div class="card card-box hoverable waves-effect">
        <a href="view/{{ $data->slug }}">
          <div class="card-image">
            <img src="{{ url('/') }}/{{ $data->cover_image }}" style="height:135px;"> 
          </div>

          <div class="card-content custom-card-content" style="padding:0 0 0 0;">
            <div class="card-course-title truncate">
              {{ $data->title }}
            </div>
            <div class="card-teacher-title truncate">
              {{ $data->user->name }} {{ $data->user->last_name }}
            </div>

            <div class="star-rating">
              @for ($i = 0; $i < 5; $i++)
                @if ($data->average_rating - $i >= 1 )
                  <i class="material-icons" style="font-size:21px;">star</i>
                @elseif ($data->average_rating - $i >= 0.5)
                  <i class="material-icons" style="font-size:21px;">star_half</i>
                @else
                  <i class="material-icons" style="font-size:21px;">star_border</i>
                @endif
              @endfor 
            </div>
          </div>

          <div class="card-action" style="padding:0 0 0 0;"> 
            <div class="card-footer-price" style="margin-right:5px;">
              @if ($data['discounted_price'] === null)
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
  @endif

</div>
