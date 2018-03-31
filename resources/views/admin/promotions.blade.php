@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการโปรโมชั่น</h3>
      <button id="create-promotion-btn" class="btn">เพิ่ม</button>
      <button class="search-btn btn">ค้นหา</button>
      <a href="" class="btn">โหลดใหม่</a>
      <button class="print-btn btn">พิมพ์</button>
    </div>

    {{--  HIDE/SHOW CHECKBOXES  --}}
    <table class="col check-box-container">
      <thead>
        <tr>
          <td>
            <input type="checkbox" class="filled-in" id="0" checked="checked" />
            <label for="0">ID</label>
          </td>
          <td>
            <input type="checkbox" class="filled-in" id="1" checked="checked" />
            <label for="1">Name & Description</label>
          </td>
          <td>
            <input type="checkbox" class="filled-in" id="2" checked="checked" />
            <label for="2">Discount</label>
          </td>
          <td>
            <input type="checkbox" class="filled-in" id="3" checked="checked" />
            <label for="3">Other</label>
          </td>
        </tr>
      </thead>
    </table>
  </div>

  {{--  DATA TABLE  --}}
  <div id="print-content" class="w90 auto-margin white" style="overflow: auto;">
    <table class="bordered responsive-table" id="myTable">
      <thead>
        <tr>
          <th class="0" onclick="sortTable(0)">ID</th>
          <th class="1" onclick="sortTable(1)">Name</th>
          <th class="1" onclick="sortTable(2)">Description</th>
          <th class="2" onclick="sortTable(3)">Type</th>
          <th class="2" onclick="sortTable(4)">Value</th>
          <th class="3" onclick="sortTable(5)">Start Date</th>
          <th class="3" onclick="sortTable(6)">Stop Date</th>
          <th class="3" onclick="sortTable(7)">Status</th>
          <th class="3">Created Date</th>
        </tr>
      </thead>

      <tbody>
        @foreach($data as $promotion)
          <tr>
            <td class="0 tooltipped" data-tooltip="{{ $promotion->id }}">{{ $promotion->id }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $promotion->name }}">{{ $promotion->name }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $promotion->description }}">{{ $promotion->description }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $promotion->discount_type }}">{{ $promotion->discount_type }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $promotion->discount_value }}">{{ $promotion->discount_value }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $promotion->start_date }}">{{ $promotion->start_date }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $promotion->stop_date }}">{{ $promotion->stop_date }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $promotion->status }}">{{ $promotion->status }}</td>
            <td class="3 tooltipped" data-tooltip="{{ $promotion->created_at }}">{{ $promotion->created_at }}</td>
            <input type="hidden" name="_promotion_id" value="{{ $promotion->id }}">
            <input type="hidden" name="_name" value="{{ $promotion->name }}">
            <input type="hidden" name="_description" value="{{ $promotion->description }}">
            <input type="hidden" name="_type" value="{{ $promotion->discount_type }}">
            <input type="hidden" name="_value" value="{{ $promotion->discount_value }}">
            <input type="hidden" name="_start_date" value="{{ $promotion->start_date }}">
            <input type="hidden" name="_stop_date" value="{{ $promotion->stop_date }}">
            <input type="hidden" name="_status" value="{{ $promotion->status }}">
          </tr>
        @endforeach
      </tbody>
    </table>

    {{--  PAGINATION  --}}
    <div class="center-align">
      {{ $data->links() }}
    </div>
  </div>

  {{--  EDIT PROMOTION MODAL BOX  --}}
  <div id="modal2" class="modal" style="width:650px; min-height:550px !important;">
    <div class="modal-content">
      <h4 class="center-align">Edit Promotion</h4>
      <form method="POST" action="{{ url('/') }}/promotion">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="promotion_id">

        <div class="input-field col">
          <label for="name" class="active">Name</label>
          <input type="text" name="name" class="validate" data-length="50">
        </div>

        <div class="input-field col">
          <label for="description" class="active">Description</label>
          <textarea type="text" name="description" 
            class="validate materialize-textarea" data-length="100"></textarea>
        </div>

        <div class="input-field col">
          <select name="type">
            <option value="VALUE">Value</option>
            <option value="PERCENT">Percent</option>
          </select>
          <label>Discount_Type</label>
        </div>

        <div class="input-field col">
          <label for="value" class="active">Discount_Value</label>
          <input type="number" name="value" class="validate">
        </div>

        <div class="input-field col">
          <label for="start_date" class="active">Start_Date</label>
          <input type="text" name="start_date" class="datepicker">
        </div>

        <div class="input-field col">
          <label for="stop_date" class="active">Stop_Date</label>
          <input type="text" name="stop_date" class="datepicker">
        </div>

        <div class="input-field col">
          <select name="status">
            <option value="ENABLED">Enable</option>
            <option value="DISABLED">Disable</option>
          </select>
          <label>Status</label>
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

  {{--  CREATE PROMOTION MODAL BOX  --}}
  <div id="modal3" class="modal" style="width:650px; min-height:550px !important;">
    <div class="modal-content">
      <h4 class="center-align">Create Promotion</h4>
      <form method="POST" action="{{ url('/') }}/promotion" id="create-promotion-form">
        {{ csrf_field() }}

        <div class="input-field col">
          <label for="name" class="active">Name</label>
          <input type="text" name="name" class="validate" data-length="50">
        </div>

        <div class="input-field col">
          <label for="description" class="active">Description</label>
          <textarea type="text" name="description" 
            class="validate materialize-textarea" data-length="100"></textarea>
        </div>

        <div class="input-field col">
          <select name="type">
            <option value="VALUE">Value</option>
            <option value="PERCENT">Percent</option>
          </select>
          <label>Discount_Type</label>
        </div>

        <div class="input-field col">
          <label for="value" class="active">Discount_Value</label>
          <input type="number" name="value" class="validate">
        </div>

        <div class="input-field col">
          <label for="start_date" class="active">Start_Date</label>
          <input type="text" name="start_date" class="datepicker">
        </div>

        <div class="input-field col">
          <label for="stop_date" class="active">Stop_Date</label>
          <input type="text" name="stop_date" class="datepicker">
        </div>

        <div class="input-field col">
          <select name="status">
            <option value="ENABLED">Enable</option>
            <option value="DISABLED">Disable</option>
          </select>
          <label>Status</label>
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

  {{--  SEARCH COURSE MODAL  --}}
  <div id="modal4" class="modal" style="width:650px; overflow:hidden;">
    <div class="modal-content">
      <h4 class="center-align">ค้นหาโปรโมชั่น</h4>
      <form method="POST">
        {{ csrf_field() }}

        <div class="input-field col">
          <label for="promotin_id" class="active">Promotion_ID</label>
          <input type="text" name="promotion_id">
        </div>

        <div class="input-field col">
          <label for="name" class="active">Name</label>
          <input type="text" name="name">
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

      // CREATE PROMOTION MODAL TRIGGER
      $('#create-promotion-btn').on('click', function(e) {
        $('#modal3').modal('open');
        document.getElementById("create-promotion-form").reset();
      });

      // EDIT PROMOTION MODAL TRIGGER
      $('tbody tr').on('click', function(e) {
        $('#modal2').modal('open');
        var promotion_id  = $(this).find("input[name='_promotion_id']").val();
        var name          = $(this).find("input[name='_name']").val();
        var description   = $(this).find("input[name='_description']").val();
        var type          = $(this).find("input[name='_type']").val();
        var value         = $(this).find("input[name='_value']").val();
        var start_date    = $(this).find("input[name='_start_date']").val();
        var stop_date     = $(this).find("input[name='_stop_date']").val();
        var status        = $(this).find("input[name='_status']").val();

        $("input[name='promotion_id']").val(promotion_id);
        $("input[name='name']").val(name);
        $("textarea[name='description']").val(description);
        $("select[name='type']").val(type);
        $("input[name='value']").val(value);
        $("input[name='start_date']").val(start_date);
        $("input[name='stop_date']").val(stop_date);
        $("select[name='status']").val(status);

        $('select').material_select();

        $("input[name='name']").focus();
        $("textarea[name='description']").focus();
        $("input[name='type']").focus();
        $("input[name='value']").focus();
        $("input[name='start_date']").focus();
        $("input[name='stop_date']").focus();
        $("input[name='status']").focus();
      });
    });
  </script>

@endsection