@extends('layouts.app')

@section('content')

  <div class="row pc-container white" style="margin-bottom:0; min-height:550px; margin-top:25px;">

    <div class="col s3">
      @include('user.menu-edit') 
    </div>

    @yield('user-edit')
    
  </div>

@endsection