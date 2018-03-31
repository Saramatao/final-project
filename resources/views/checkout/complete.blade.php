@extends('layouts.app')

@section('content')

<div class="teal w100" style="height:135px;">
  <div class="pc-container auto-margin h100">
    <div style="font-size:2em; line-height:135px;">
      ชำระเงินสำเร็จ
    </div>
  </div>
</div>

<div class="pc-container auto-margin">
  <div class="row">
    <div class="col w70">

      @foreach (Session::get('complete_courses') as $course)
        <div class="row card-panel">
          <div class="col w20">
            <img src="{{ url('/') }}/{{ $course->cover_image }}" 
              style="width:125px; height:75px;"> 
          </div>

          <div class="col w60">
            <div>
              {{ $course->title }}
            </div>
            <div>
              โดย {{ $course->user->name }} {{ $course->user->last_name }}
            </div>
          </div>

          <div class="col w10">
            <a href="/view/{{ $course->slug }}" class="btn">ไปยังคอร์สเรียน</a>
          </div>
        </div>
      @endforeach
    
    </div>
  </div>
</div>

@endsection