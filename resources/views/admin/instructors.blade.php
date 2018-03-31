@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการผู้สอน</h3>
      <button class="search-btn btn">ค้นหา</button>
      <a href="" class="btn">โหลดใหม่</a>
      <button class="print-btn btn">พิมพ์</button>
    </div>

    {{--  HIDE/SHOW CHECKBOXES  --}}
    <div class="col check-box-container">
      <table>
        <thead>
          <tr>
            <td>
              <input type="checkbox" class="filled-in" id="0" checked="checked" />
              <label for="0">ID & Name</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="1" checked="checked" />
              <label for="1">Email & Status</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="2" checked="checked" />
              <label for="2">Details</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="3" checked="checked" />
              <label for="3">Contact Details</label>
            </td>
          </tr>
        </thead>
      </table>
    </div> 
  </div>

  {{--  DATA TABLE  --}}
  <div id="print-content" class="w90 auto-margin white" style="overflow: auto;">
    <table class="bordered responsive-table" id="myTable">
      <thead>
        <tr>
          <th class="0" onclick="sortTable(0)">ID</th>
          <th class="0" onclick="sortTable(1)">Name</th>
          <th class="0" onclick="sortTable(2)">Last Name</th>
          <th class="1" onclick="sortTable(3)">Email</th>
          <th class="1" onclick="sortTable(4)">Status</th>
          <th class="2" onclick="sortTable(5)">Headline</th>
          <th class="2" onclick="sortTable(6)">Biography</th>
          <th class="1" onclick="sortTable(7)">Paypal ID</th>
          <th class="3" onclick="sortTable(8)">Website</th>
          <th class="3" onclick="sortTable(9)">Twitter</th>
          <th class="3" onclick="sortTable(10)">Facebook</th>
          <th class="3" onclick="sortTable(11)">LinkedIn</th>
          <th class="3" onclick="sortTable(12)">Youtube</th>
          <th class="3" onclick="sortTable(13)">Git Hub</th>
          <th class="2">Avatar</th>
          <th class="2" onclick="sortTable(15)">Teaching Date</th>
          <th class="2" onclick="sortTable(16)">Joined Date</th>
        </tr>   
      </thead>

      <tbody>
        @foreach($data as $instructor)
          <tr>
            <td class="0 tooltipped" data-tooltip="{{ $instructor->user_id }}">{{ $instructor->user_id }}</td>
            <td class="0 tooltipped" data-tooltip="{{ $instructor->user->name }}">{{ $instructor->user->name }}</td>
            <td class="0 tooltipped" data-tooltip="{{ $instructor->user->last_name }}">{{ $instructor->user->last_name }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $instructor->user->email }}">{{ $instructor->user->email }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $instructor->user->status }}">{{ $instructor->user->status }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $instructor->user->student->headline }}">{{ $instructor->user->student->headline }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $instructor->user->student->biography }}">{{ $instructor->user->student->biography }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $instructor->paypal_id }}">{{ $instructor->paypal_id }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $instructor->website }}">{{ $instructor->website }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $instructor->twitter }}">{{ $instructor->twitter }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $instructor->facebook }}">{{ $instructor->facebook }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $instructor->linkedin }}">{{ $instructor->linkedin }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $instructor->youtube }}">{{ $instructor->youtube }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $instructor->github }}">{{ $instructor->github }}</td>
            <td class="2"><a href="{{ url('/') }}/{{ $instructor->user->student->photo }}" target="_blank">Link</a></td>
            <td class="2 tooltipped" data-tooltip="{{ $instructor->created_at }}">{{ $instructor->created_at }}</td>    
            <td class="2 tooltipped" data-tooltip="{{ $instructor->user->created_at }}">{{ $instructor->user->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{--  PAGINATION  --}}
    <div class="center-align">
      {{ $data->links() }}
    </div>
  </div>

  {{--  SEARCH MODAL  --}}
  <div id="modal4" class="modal" style="width:650px; overflow:hidden;">
    <div class="modal-content">
      <h4 class="center-align">Search Instructor</h4>
      <form method="POST">
        {{ csrf_field() }}

        <div class="input-field col">
          <label for="user_id" class="active">ID</label>
          <input type="text" name="user_id">
        </div>

        <div class="input-field col">
          <label for="name" class="active">Name</label>
          <input type="text" name="name">
        </div>

        <div class="input-field col">
          <label for="last_name" class="active">Last Name</label>
          <input type="text" name="last_name">
        </div>

        <div class="input-field col">
          <label for="email" class="active">Email</label>
          <input type="text" name="email">
        </div>

        <div class="center-align mar-top-25">
          <button type="submit" style="margin-top:10px; margin-bottom:10px; width:255px;" 
            class="btn btn-submit waves-effect">
            Submit
          </button> 
        </div>
      </form>
    </div>
  </div>

  {{--  JS FUNCTIONS  --}}
  <script>
    $(document).ready(function() {

      // SEARCH COURSE MODAL TRIGGER
      $('.search-btn').on('click', function(e){
        $('#modal4').modal('open');
      });

    });
  </script>

@endsection