@extends('course.template-edit')

@section('course-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>กำหนดราคาและคูปองส่วนลด</h4>
    </div>
    
    <div class="col">
      <form role="form" method="POST" action="{{ url('/') }}/course/price">
        {{ csrf_field() }}
        <input type="hidden" name="course_id" value="{{ $data->id }}">

        <div class="input-field col s4">
          <select name="price">
            <option value="0" disabled>ราคาคอร์สเรียน</option>
            <option value="0"
              {{ ($data->price == 0) ? 'selected' : '' }}>เรียนฟรี</option>       
            <option value="200"
              {{ ($data->price == 200) ? 'selected' : '' }}>฿200</option>
            <option value="300"
              {{ ($data->price == 300) ? 'selected' : '' }}>฿300</option>
            <option value="400"
              {{ ($data->price == 400) ? 'selected' : '' }}>฿400</option>
            <option value="500"
              {{ ($data->price == 500) ? 'selected' : '' }}>฿500</option>
            <option value="600"
              {{ ($data->price == 600) ? 'selected' : '' }}>฿600</option>
            <option value="700"
              {{ ($data->price == 700) ? 'selected' : '' }}>฿700</option>
            <option value="800"
              {{ ($data->price == 800) ? 'selected' : '' }}>฿800</option>
            <option value="900"
              {{ ($data->price == 900) ? 'selected' : '' }}>฿900</option>
            <option value="1000"
              {{ ($data->price == 1000) ? 'selected' : '' }}>฿1000</option>
          </select>
          <label>ราคาคอร์สเรียน</label>
        </div>

        <div class="center-align col s4 mar-top-25">
          <button type="submit" class="btn btn-submit">
            บันทึก
          </button> 
        </div>
      </form>
    </div>

    <div>
      <form role="form" class="form_target" method="POST" action="{{ url('/') }}/course/coupon">
        {{ csrf_field() }}
        <input type="hidden" name="course_id" value="{{ $data->id }}">
        <div class="col s12">

          <div class="input-field col s4">
            <input name="discounted_price" type="number" min="0" max="{{ $data->price }}"
              class="validate" style="margin-bottom:0;" value="0">
            <label class="active" for="discounted_price">ราคาหลังจากการลด</label>
          </div>

          <div class="input-field col s4">
            <input name="quantity" type="number" min="1" max="1000000000"
              class="validate" style="margin-bottom:0;" value="1">
            <label class="active" for="quantity">จำนวนคูปอง</label>
          </div>
          
          <div class="input-field col s4">
            <input name="stop_date" type="date"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="stop_date">วันหมดอายุ</label>
          </div>

          <div class="center-align col s12 mar-top-25">
            <button type="submit" class="btn btn-submit">
              บันทึก
            </button> 
          </div>
      
        </div>
      </form>
    </div>

    <table>
      <tr>
        <td>
          โค้ดคูปอง
        </td>
        <td>
          ราคาหลังจากการลด
        </td>
        <td>
          จำนวนที่เหลืออยู่
        </td>
        <td>
          วันที่หมดอายุ
        </td>
        <td>
          สถานะ
        </td>
      </tr>
      @foreach ($data->coupon as $coupon)
        <tr>
          <td>
            {{ $coupon->code }}
          </td>
          <td>
            {{ $coupon->discounted_price }}
          </td>
          <td>
            {{ $coupon->quantity }}
          </td>
          <td>
            @if ($coupon->stop_date === null)
              -
            @else
              {{ $coupon->stop_date }}
            @endif
          </td>
          <td>
            {{ $coupon->status }}
          </td>
        </tr>
      @endforeach
    </table>
    
  </div>

  {{--  AJAX REQUEST  --}}
  <script type="text/javascript">
    $(document).ready(function() {
      $("form").submit(function(e) {
        e.preventDefault();
        ajaxFormRequest($(this));
      });
    });
  </script>

@endsection