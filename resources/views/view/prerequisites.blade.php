@if ( count($data->prerequisite))
  <div class="row pc-container">
    <div class="col s8 z-depth-1" style="padding-bottom: 10px;""> 
      <p style="font-size: 2em;">สิ่งที่ต้องเตรียมพร้อม</p>
      <div class="col s12"> 

        @foreach ($data->prerequisite as $prerequisite)
          <div class="truncate">
            <i class="material-icons">check</i>
            {{ $prerequisite->detail }}
          </div>
        @endforeach

      </div>
    </div> 
  </div> 
@endif