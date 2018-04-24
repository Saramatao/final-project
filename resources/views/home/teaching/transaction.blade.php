@extends('layouts.app')

@section('content')

  @include('home.teaching.banner')

  <div id="test1" class="pc-container auto-margin" style="min-height:500px;">
      <h4 class="center-align">ประวัติการขายคอร์สเรียน</h4>
      <table>
        <tr>
          <td colspan=2 style="font-size:1.5em;">
            <div>
              รายได้ทั้งหมด : {{ $format_data->total_get_price }} ฿
            </div>
            <div>
              จำนวนคอร์สเรียนที่ขายไปทั้งหมด : {{ $format_data->total_sold_qty }} ครั้ง
            </div>
          </td>
        </tr>
        <tr>
          <td colspan=2 style="width:50%">
            <canvas id="qtyChart" style="max-width:100%; min-height:100%;"></canvas>
          </td>
        </tr>
        <tr>
          <td colspan=2 style="width:50%">
            <canvas id="profitChart" style="max-width:100%; min-height:100%;"></canvas>        
          </td>
        </tr>
      </table>

      <ul class="collapsible">
        @foreach ($myTeachCourses as $course)
          <li>
            <div class="collapsible-header row">
              <div class="col s9">
                <i class="material-icons">receipt</i>
                <span style="font-weight:bold;">คอร์สเรียน</span>
                {{ $course->id }} ({{ $course->title }})
              </div>
              <div class="col s3">
                <i class="material-icons">attach_money</i>
                <span style="font-weight:bold;">ยอดขาย</span>
                {{ $course->total_get_price }} ฿
                (ขาย {{ $course->total_sold_qty }} ครั้ง)
              </div>
            </div>
            <div class="collapsible-body">
              @if ( count($course->transaction) > 0)
                <table class="highlight">
                  <thead>
                    <tr>
                      <th>รหัสการสั่งซื้อ</th>
                      <th>ชื่อคอร์สเรียน</th>
                      {{-- <th>ราคาขาย</th> --}}
                      <th>เงินที่จะได้รับ</th>
                      <th>วันที่ชำระเงิน</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($course->transaction as $purchasedetail)
                      <tr>
                        <td> {{ $purchasedetail->purchase_id }} </td>
                        <td> {{ $purchasedetail->course->title }} </td>
                        {{-- <td> {{ $purchasedetail->sold_price }} </td> --}}
                        <td> {{ $purchasedetail->get_price }} </td>
                        <td> {{ $purchasedetail->created_at }} </td>
                      </tr>                     
                    @endforeach
                  </tbody>
                </table>
              @else
                ยังไม่มีการชำระเงิน
              @endif
            </div>
          </li>
        @endforeach
      </ul>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
      var profitChart = document.getElementById("profitChart").getContext('2d');
      var qtyChart = document.getElementById("qtyChart").getContext('2d');

      var course_title = [
        @foreach ($myTeachCourses as $course)
          "{{ $course->title }}",
        @endforeach  
      ];

      var course_get_price = [
        @foreach ($myTeachCourses as $course)
          "{{  $course->total_get_price }}",
        @endforeach 
      ];

      new Chart(profitChart, {
          type: 'bar',
          data: {
              labels: [
                @foreach ($myTeachCourses as $course)
                  "{{ $course->title }}",
                @endforeach  
              ],
              datasets: [{
                  label: ['รายได้ทั้งหมด'],
                  data: [
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_get_price }}",
                    @endforeach  
                  ],
                  backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });

      new Chart(qtyChart, {
          type: 'bar',
          data: {
              labels: [
                @foreach ($myTeachCourses as $course)
                  "{{ $course->title }}",
                @endforeach  
              ],
              datasets: [{
                  label: ['จำนวนคอร์สเรียนที่ขายได้ทั้งหมด'],
                  data: [
                    @foreach ($myTeachCourses as $course)
                      "{{  $course->total_sold_qty }}",
                    @endforeach  
                  ],
                  backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
    </script>

@endsection