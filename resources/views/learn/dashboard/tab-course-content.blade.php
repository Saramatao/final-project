<div id="course-content" class="card-panel">

  <!-- <div class="flex">
    {{--  SEARCH BAR  --}}
    <div class="w50">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label style="margin-top:-10px;" class="label-icon" for="search">
            <i class="material-icons">search</i>
          </label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>

    {{--  SORT DROPDOWN  --}}
    <div class="w20">
      <div class="input-field">
        <select>
          <option value="" disabled selected>Section</option>
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
        </select>
        <label>Sort by</label>
      </div>
    </div>
  </div> -->

  <div style="margin-bottom:25px;">
    เนื้อหาบทเรียน
  </div>

  {{--  CURRICULUM  --}}
  <ul class="collapsible popout" data-collapsible="expandable">
    @foreach ($data->section as $section)
      <li>
        <div class="collapsible-header">
          <i class="material-icons">expand_more</i>
          <div style="width:1000px;"> {{ $section->title }} </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
          <ul class="collection">
            @foreach ($section->lecture as $lecture)
              <a href="{{ url('/') }}/learn/{{ $data->slug }}/lecture/{{ $lecture->id }}">
                  <li style="padding-left: 2em;" class="collection-item">
                    <span>{{ $lecture->title }}</span>
                    @if ($lecture->learn_status === true)
                      <span class="right"><i class="material-icons">check_box</i></span>
                    @else
                      <span class="right"><i class="material-icons">check_box_outline_blank</i></span>
                    @endif
                    <span class="right" style="margin-right:15px;">{{ $lecture->content_type }}</span>
                  </li>
              </a>
            @endforeach
          </ul>
        </div>
      </li>
    @endforeach
  </ul>

</div>