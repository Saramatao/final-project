<div class="row pc-container">
  <div class="col s8 z-depth-1"> 
    <p style="font-size: 2em;">เนื้อหาบทเรียนในคอร์ส</p>
    <div class="col s12"> 

      <ul class="collapsible popout" data-collapsible="expandable">
        @foreach ($data->section as $section)
          <li>
            <div class="collapsible-header">
              <i class="material-icons">expand_more</i>
              <div style="width:1000px;"> {{ $section->title }} </div>
              <i class="material-icons">access_time</i>03:21:42
            </div>
            <div class="collapsible-body" style="padding:0;">
              <ul class="collection">
                @foreach ($section->lecture as $lecture)
                  <li style="padding-left: 2em;" class="collection-item">
                    @if ($lecture->status == 'FREE')
                      <i class="material-icons">lock_open</i>
                    @else
                      <i class="material-icons">lock</i>
                    @endif
                    <span>{{ $lecture->title }}</span>
                    <span class="right">16:50</span>
                    <span class="right">{{ $lecture->content_type }}</span>
                    @if ($lecture->status == 'FREE')
                      <span class="right">ดูตัวอย่าง</span>
                    @endif
                  </li>
                @endforeach
              </ul>
            </div>
          </li>
      @endforeach
      </ul>

    </div>
  </div> 
</div> 