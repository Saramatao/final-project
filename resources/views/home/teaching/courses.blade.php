<div id="test1" class="pc-container auto-margin" style="min-height:500px;">
  @foreach ($data as $course)
    <a href="{{ url('/') }}/course/{{ $course->id }}/title" 
      class="flex mar-top-10 mar-bot-10 card hoverable">
      {{--  <div class="flex">  --}}
        <div style="width:300px;">
          <img src="{{ url('/') }}/{{ $course->cover_image }}" 
            class="mar-top-10 mar-left-10 mar-right-10" style="width:250px; height:175px;"> 
        </div>
        <div class="w100 flex" style="padding-top:10px; color: #333">

          <div class="w50">
            <div style="font-weight: bold;">
              {{ $course->title }}
            </div>
            <div style="color: #888">
              {{ $course->slug }}
            </div>
            <div style="color: #888">
              {{ $course->subtitle }}
            </div>
            <div>
              ภาษาที่ใช้ในการสอน: {{ $course->language }}
            </div>
            <div>
              ระดับความยาก: {{ $course->level }}
            </div>
          </div>

          <div>
            <div>
              สถานะ: {{ $course->status }}
            </div>
            <div>
              ใบอนุญาติ:
              @if ($course->license == 'NOT') 
                ยังไม่อนุมัติ
              @elseif ($course->license == 'PASS') 
                อนุมัติ
              @elseif ($course->license == 'BAN') 
                ถูกแบน
              @endif
            </div>
            <div>
              ราคาสุทธิ: ฿ {{ $course->price }}
            </div>
          </div>
          
        </div>
      {{--  </div>  --}}
    </a>
  @endforeach

</div>