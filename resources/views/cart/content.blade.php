<div class="teal w100" style="height:135px;">
  <div class="pc-container auto-margin h100">
    <div style="font-size:2em; line-height:135px;">
      ตระกร้าสินค้า
    </div>
  </div>
</div>

<div class="pc-container auto-margin">

  <div class="row">

    <div class="col w80" style="min-height: 500px;">

      @if ($data != null)
        <div style="font-size: 1.5em; margin-top:25px;">
          {{ count($data) }} คอร์สเรียนในตระกร้า
        </div>
        @foreach ($data as $course)
          <div class="row card-panel">
            <div class="col w20">
              <a href="{{ url('/') }}/view/{{ $course->slug }}">
                <img src="{{ url('/') }}/{{ $course->cover_image }}" 
                  style="width:150px; height:100px;"> 
              </a>
            </div>

            <div class="col w50">
              <div style="font-weight: bold;">
                {{ $course->title }}
              </div>
              <div>
                โดย {{ $course->user->name }} {{ $course->user->last_name }}
              </div>
              <div>
                {{ $course->description }}
              </div>
            </div>

            <div class="col w20">
              <form action="{{ url('/') }}/cart" method="POST">
                {{ csrf_field() }}
                {{ method_field('delete') }}

                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <button type="submit" class="btn btn-danger">ลบออก</button>
              </form>
            </div>

            <div class="col w10">
              @if ($course->promotion === null)
                ฿{{ $course->price }}
              @else
                <span style="text-decoration: line-through;">
                  ฿{{ $course->price }}
                </span>
                ฿{{ $course->discounted_price }}
              @endif
            </div>
          </div>
        @endforeach
       
      @else
        <div style="font-size: 1.5em; margin-top:25px;">
          ไม่มีคอร์สเรียนในตระกร้า
        </div>
      @endif
      
    </div>

    <div class="col w20 card-panel center-align">
      รวมทั้งหมด
      <div>
        ฿{{ $totalPrice }}
      </div>
      <div class="center-align" style="padding-bottom: 25px;">
        @if (Auth::guest())
          <div class="lime">กรุณาเข้าสู่ระบบเพื่อชำระเงิน</div>
        @else
          <a href="/checkout" class="waves-effect waves-light btn">ชำระเงิน</a>
        @endif
      </div>
    </div>

  </div>

</div>
