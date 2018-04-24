@extends('layouts.app')

@section('content')

  <div class="row pc-container white" style="margin-bottom:0; min-height:550px; margin-top:25px;">
    <h3>ประวัติการสั่งซื้อ</h3>
    <table class="striped">
      <thead>
        <tr>
          <th>รหัสการสั่งซื้อ</th>
          <th>วันที่ชำระ</th>
          <th>รหัสคอร์สเรียน</th>
          <th>ชื่อคอร์สเรียน</th>
          <th>เงินที่ชำระ</th>
          <th>สถานะ</th>
          <th>โปรโมชั่น</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($user->purchase as $purchase)
          @foreach ($purchase->purchasedetail as $purchasedetail)
            <tr>
              <td>{{ $purchase->id }}</td>
              <td>{{ $purchase->created_at }}</td>
              <td>{{ $purchasedetail->course_id }}</td>
              <td>{{ $purchasedetail->course->title }}</td>
              <td>{{ $purchasedetail->sold_price }}</td>
              <td>{{ $purchasedetail->status === 'PAID' ? 'ชำระแล้ว' : '' }}</td>
              <td>{{ $purchasedetail->promotion_id }}</td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  </div>

@endsection