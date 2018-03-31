<div id="overview">

  {{--  ACTIVITY  --}}
  <div>
    ความเคลื่อนไหวล่าสุด
  </div>

  <div class="flex pc-container">

    {{--  STUDENT QUESTIONS  --}}
    <div class="col w50">
      <div class="card-panel" style="min-height:280px;">
        <div style="margin-bottom:25px;">
          คำถามจากผู้เรียน
        </div>

        @foreach ($data->question as $question)
          <div class="flex">
            <div>
              <img src="{{ url('/') }}/{{ $question->user->student->photo }}" 
                class="circle" style="width:35px; height:35px;"> 
            </div>
            <div style="margin-left:25px; padding-top:5px;">
              {{ $question->title }}
            </div>
          </div>
        @endforeach
        
        @if ( count($data->question) > 4)
          <div class="center-align mar-top-25">
            <a id="viewMoreQA" href="#qa">ดูเพิ่มเติม</a>
          </div>
        @elseif ( count($data->question) == 0)
          <div class="center-align">
            ยังไม่มีการตั้งคำถามใดๆจากผู้เรียน
          </div>
        @endif
      </div>
    </div>

    {{--  INSTRUCTOR ANNOUNCEMENTS  --}}
    <div class="col w50">
      <div class="card-panel" style="min-height:280px;">
        <div style="margin-bottom:25px;">
          ประกาศจากผู้สอน
        </div>

        @foreach ($data->announcement as $announcement)
          <div class="flex">
            <div>
              <img src="{{ url('/') }}/{{ $data->user->student->photo }}" 
                class="circle" style="width:35px; height:35px;"> 
            </div>
            <div style="margin-left:25px; padding-top:5px;">
              {{ $announcement->title }}
            </div>
          </div>
        @endforeach

        @if ( count($data->announcement) > 4)
          <div class="center-align mar-top-25">
            <a id="viewMoreAnnouncement" href="#announcements">ดูเพิ่มเติม</a>
          </div>
        @elseif ( count($data->announcement) == 0)
          <div class="center-align">
            ยังไม่มีประกาศใดๆจากผู้สอน
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="card-panel"> 

    {{--  ABOUT COURSE  --}}
    <div class="flex">
      <div style="width:200px;">
        ชื่อคอร์สเรียน
      </div>
      <div style="width:100%;">
        {{ $data->subtitle }}
      </div>
    </div>

    {{--  MORE DETAIL  --}}
    <div class="flex">
      <div style="width:200px;">
        รายละเอียด
      </div>

      <div class="flex" style="width:100%; margin-bottom:25px;">
        <ul style="width: 45%">
          <li>
            {{ $data->count_lecture }} บทเรียน
          </li>

          <li>
            วีดีโอ: 5.5 hours
          </li>

          <li>
            ระดับ: {{ $data->level }}
          </li>
        </ul>

        <ul style="width: 45%">
          <li>
            ลงทะเบียน: {{ $data->count_enrollment }} ครั้ง 
          </li>

          <li>
            ภาษา: {{ $data->language }}
          </li>
        </ul>
      </div>
    </div>

    {{--  DESCRIPTION  --}}
    <div class="flex" style="margin-bottom:25px;">
      <div style="width:200px;">
        คำอธิบาย
      </div>

      <div style="width:100%;">
        {{ $data->description }}
      </div>
    </div>

    {{--  ABOUT INSTRUCTOR  --}}
    <div>
      เกี่ยวกับผู้สอน
      <div class="flex">

        <div style="width:200px;">
          <img src="{{ url('/') }}/{{ $data->user->student->photo }}" style="width:150px;"> 
        </div>
        
        <div style="width:100%;">
          <div>
            {{ $data->user->name }} {{ $data->user->last_name }}
          </div>
          <div>
            {{ $data->user->student->headline }}
          </div>
          <div>
            @if ($data->user->instructor->website !== null)
              <a target="_blank" href="http://{{ $data->user->instructor->website }}">
                <img src="{{ asset('images/world.svg') }}" style="width:35px;">
              </a>
            @endif
            @if ($data->user->instructor->twitter !== null)
              <a target="_blank" href="https://twitter.com/{{ $data->user->instructor->twitter }}">
                <img src="{{ asset('images/twitter.svg') }}" style="width:35px;">
              </a>
            @endif 
            @if ($data->user->instructor->facebook !== null)
              <a target="_blank" href="https://facebook.com/{{ $data->user->instructor->facebook }}">
                <img src="{{ asset('images/facebook.svg') }}" style="width:35px;">
              </a>
            @endif
            @if ($data->user->instructor->youtube !== null) 
              <a target="_blank" href="https://youtube.com/channel/{{ $data->user->instructor->youtube }}">
                <img src="{{ asset('images/youtube.svg') }}" style="width:35px;"> 
              </a>
            @endif
            @if ($data->user->instructor->github !== null)
              <a target="_blank" href="https://github.com/{{ $data->user->instructor->github }}">
                <img src="{{ asset('images/github.svg') }}" style="width:35px;">
              </a>
            @endif 
            @if ($data->user->instructor->linkedin !== null)
              <a target="_blank" href="https://linkedin.com/in/{{ $data->user->instructor->linkedin }}">
                <img src="{{ asset('images/linkedin.svg') }}" style="width:35px;">
              </a> 
            @endif
          </div>
          <div>
            {{ $data->user->student->biography }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>