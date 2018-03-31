@if ( count($data->review))
  <div class="row pc-container">
    <div class="col s8 z-depth-1" style="padding-bottom: 10px;">
      <div style="font-size: 2em;">ความคิดเห็นจากผู้เรียน</div>
      
      @foreach ($data->review as $review)
        @if ($review->comment !== null)
          <div class="row">
            <div class="col s4" style="margin-bottom:25px;"> 
              <div style="width:50px; height:50px; background-color:grey; float:left;">
                <img src="{{ url('/') }}/{{ $review->user->student->photo }}" style="height:50px; width:50px;"> 
              </div>
  
              <ul>
                <li>
                  เมื่อ {{ $review->created_at->format('d M Y') }}
                </li>
                <li>
                  {{ $review->user->name }} {{ $review->user->last_name }}
                </li>
              </ul>
            </div>
  
            <div class="col s8">
              <div>
                @php ($star = 0)
                @for ($i = 0; $i < $review->rating; $i++, $star++)
                  <i class="material-icons" style="font-size:21px;">star</i>
                @endfor
                @for ($i = 0; $i < 5-$star; $i++)
                  <i class="material-icons" style="font-size:21px;">star_border</i>
                @endfor
              </div>
              <div>
                {{ $review->comment }}
              </div>
              <div>
                <a class="waves-effect waves-light btn">ถูกใจ</a>
                <a class="waves-effect waves-light btn red">รายงานปัญหา</a>
              </div>
            </div>
          </div>
        @endif
      @endforeach

    </div>
  </div> 
@endif