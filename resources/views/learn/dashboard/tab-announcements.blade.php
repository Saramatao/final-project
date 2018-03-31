<div id="announcements">

  @if ( count($data->announcement) > 0)
    @foreach ($data->announcement as $announcement)

    {{--  INSTRUCTOR  --}}
    <div class="row">
      <div class="col w10">
        <img src="{{ url('/') }}/{{ $data->user->student->photo }}" 
          class="circle" style="width:75px; height:75px;"> 
      </div>

      <div class="col w90">
        <div>
          {{ $data->user->name }} {{ $data->user->last_name }}
        </div>
        <div>
          ได้โพสต์ประกาศนี้ไว้เมื่อ {{ $announcement->created_at }}
        </div>
      </div>
    </div>

    {{--  ANNOUCEMENT  --}}
    <div class="row">
      <div class="col w100 bold">
        {{ $announcement->title }}
      </div>
      <div class="col w100">
        {{ $announcement->detail }}
      </div>
    </div>

    @endforeach
  @else
    <div class="center-align">ไม่มีการประกาศจากผู้สอน</div>
  @endif

</div>