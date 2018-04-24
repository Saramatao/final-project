@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการหมวดหมู่</h3>
      <button class="modal-create-cat-btn btn">เพิ่ม</button>
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
              <label for="0">รหัสหมวดหมู่</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="1" checked="checked" />
              <label for="1">ชื่อ & รายละเอียด</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="2" checked="checked" />
              <label for="2">อื่นๆ</label>
            </td>
            <td></td>
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
          <th class="0" onclick="sortTable(0)">รหัส<i class="material-icons" style="font-size:16px;">swap_vert</i></th>
          <th class="1" onclick="sortTable(1)">ชื่อ<i class="material-icons" style="font-size:16px;">swap_vert</i></th>
          <th class="1" onclick="sortTable(2)">รายละเอียด<i class="material-icons" style="font-size:16px;">swap_vert</i></th>
          <th class="2" onclick="sortTable(3)">วันที่สร้าง<i class="material-icons" style="font-size:16px;">swap_vert</i></th>
          <th class="2" onclick="sortTable(4)">จำนวนคอร์สเรียน<i class="material-icons" style="font-size:16px;">swap_vert</i></th>
        </tr>   
      </thead>

      <tbody>
        @foreach($data as $category)
          <tr class="data-cell">
            <td class="0 tooltipped" data-tooltip="{{ $category->id }}">{{ $category->id }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $category->name }}">{{ $category->name }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $category->description }}">{{ $category->description }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $category->created_at }}">{{ $category->created_at }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $category->count_course }}">{{ $category->count_course }}</td>
            <input type="hidden" name="_category_id" value="{{ $category->id }}">
            <input type="hidden" name="_name" value="{{ $category->name }}">
            <input type="hidden" name="_description" value="{{ $category->description }}">
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{--  MODAL BOX EDIT CAT  --}}
  <div id="modal2" class="modal" style="width:650px;">
    <div class="modal-content">
      <h4 class="center-align">Edit Category</h4>
      <form method="POST" action="{{ url('/') }}/category">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="category_id">

        <div class="input-field col">
          <label for="name" class="active">Name</label>
          <input type="text" name="name" class="validate" data-length="50">
        </div>

        <div class="input-field col">
          <label for="description" class="active">Description</label>
          <input type="text" name="description" class="validate" data-length="100">
        </div>

        {{--  EDIT BUTTON  --}}
        <div class="center-align mar-top-25">
          <button type="submit" style="margin-top:10px; margin-bottom:10px; width:255px;" 
            class="btn btn-submit waves-effect">
            Submit
          </button> 
        </div>
      </form>

      {{--  DELETE BUTTON  --}}
      <form method="POST" action="{{ url('/') }}/category">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="hidden" name="category_id">

        <div class="center-align">
          <button type="submit" style="margin-bottom:10px; width:255px;" 
            class="btn red waves-effect delete-cat-btn">
            DELETE
          </button> 
        </div>
      </form>
    </div>
  </div>

  {{--  MODAL BOX CREATE CAT  --}}
  <div id="modal3" class="modal" style="width:650px;">
    <div class="modal-content">
      <h4 class="center-align">Create Category</h4>
      <form method="POST" action="{{ url('/') }}/category">
        {{ csrf_field() }}

        <div class="input-field col">
          <label for="name" class="active">Name</label>
          <input type="text" name="name" class="validate" data-length="50">
        </div>

        <div class="input-field col">
          <label for="description" class="active">Description</label>
          <input type="text" name="description" class="validate" data-length="100">
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
    $(document).ready(function(){

      // MODAL CREATE CATEGORY TRIGGER
      $('.modal-create-cat-btn').on('click', function(e){
        e.preventDefault();
        $('#modal3').modal('open');
        
        $("input[name='name']").val('');
        $("input[name='description']").val('');

        $("input[name='name']").focus();
      });

      // MODAL EDIT CATEGORY TRIGGER
      $('tr.data-cell').on('click', function(e){
        $('#modal2').modal('open');
        var cat_id = $(this).find("input[name='_category_id']").val()
        var name = $(this).find("input[name='_name']").val()
        var des = $(this).find("input[name='_description']").val()

        $("input[name='category_id']").val(cat_id);
        $("input[name='name']").val(name);
        $("input[name='description']").val(des);

        $("input[name='name']").focus();
        $("input[name='description']").focus();
      });

      // CONFIRM DELETE CATEGORY
      $('.delete-cat-btn').on('click', function(e){
        if(! confirm('Are you sure you want to delete this category?'))
          e.preventDefault();
      });

    });
  </script>

@endsection