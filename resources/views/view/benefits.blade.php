@if (count($data->benefit))
  <div class="row pc-container">
    <div class="col s8 z-depth-1" style="padding-bottom: 10px;"> 
      <div style="font-size: 2em;">ประโยชน์ที่จะได้รับจากการเรียน</div>
      <div class="col s12"> 

        @foreach ($data->benefit as $benefit)
          <div class="truncate">
            <i class="material-icons">check</i>
            {{ $benefit->detail }}
          </div>
        @endforeach

      </div>
    </div> 
  </div>
@endif