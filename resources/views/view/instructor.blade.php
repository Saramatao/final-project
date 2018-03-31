<div class="row pc-container">
  <div class="col s8 z-depth-1" style="padding-bottom: 10px;"> 
    <p style="font-size: 2em;">เกี่ยวกับผู้สอน</p>

    <div class="col s4">
    
      <div style="width:150px; height:150px; background-color:grey;">
        <img src="{{ url('/') }}/{{ $data->user->student->photo }}" style="height:150px; width:150px;">
      </div>

      <div style="margin-top:10px;">
        <div style="display:flex;">
          <div><i class="material-icons">face</i></div>
          <div style="margin-left:10px;">นักเรียน 682</div>
        </div>
        <div style="display:flex;">
          <div><i class="material-icons">star</i></div>
          <div style="margin-left:10px;">ค่าเฉลี่ยคะแนน 4.7</div>
        </div>
        <div style="display:flex;">
          <div><i class="material-icons">comment</i></div>
          <div style="margin-left:10px;">คำวิจารณ์ 240</div>
        </div>
        <div style="display:flex;">
          <div><i class="material-icons">content_paste</i></div>
          <div style="margin-left:10px;">คอร์สเรียน 12</div>
        </div>
      </div>
    </div>

    <div class="col s8">

      <div style="font-size: 1.5em;">{{ $data->user->name }} {{ $data->user->last_name }}</div>
      <div style="font-size: 1.5em;">{{ $data->user->student->headline }}</div>
      <div>
        {{ $data->user->student->biography }}
      </div>
      
    </div> 

  </div> 
</div> 