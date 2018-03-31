<div class="row pc-container">
  <div class="col s8 z-depth-1" style="padding-bottom: 10px;">
    <p style="font-size: 2em;">เกี่ยวกับคอร์สเรียน</p>

    <div class="col s12"> 

      <div>
        {{ $data->description }}
      </div>

      @if ( count($data->target))
        <span style="font-size: 1.5em;">กลุ่มเป้าหมาย</span>
        <ul>
        @foreach ($data->target as $target)
          <li class="truncate">
            <i class="material-icons">keyboard_arrow_right</i>
            {{ $target->detail }}
          </li>
        @endforeach
        </ul>
      @endif

    </div>
  </div> 
</div> 