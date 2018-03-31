@extends('layouts.app')

@section('content')

  @include('course.banner') 

  <div class="row white pc-container" style="margin-bottom:0; min-height:550px;">

    @include('course.menu') 

    @yield('course-edit')
    
  </div>

@endsection