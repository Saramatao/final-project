@if ( count($data->review))
  <div class="row pc-container">
    <div class="col s8 z-depth-1" style="padding-bottom: 10px;"> 
      <div style="font-size: 2em;">คะแนนการวิจารณ์</div>

      <div class="col s12"> 
        <div style="font-size: 5em;">
          {{ $data->average_rating }}
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

        <div>
          ค่าเฉลี่ยคะแนนวิจารย์
        </div>
      </div> 
    </div> 
  </div> 
@endif