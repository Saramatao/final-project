@extends('admin.app')

@section('content')

  <div class="container mar-top-25">

    <div class="col center-align">
      <h3>จัดการโฆษณา</h3>
      <button class="modal-create-adv-btn btn">เพิ่ม</button>
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
              <label for="0">Course ID</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="1" checked="checked" />
              <label for="1">Name & Description</label>
            </td>
            <td>
              <input type="checkbox" class="filled-in" id="2" checked="checked" />
              <label for="2">Other</label>
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
          <th class="0" onclick="sortTable(0)">Course ID</th>
          <th class="1" onclick="sortTable(1)">Ads. Title</th>
          <th class="1" onclick="sortTable(2)">Ads. Detail</th>
          <th class="2" onclick="sortTable(3)">Course Title</th>
          <th class="2" onclick="sortTable(4)">Course Cover</th>
          <th class="2" onclick="sortTable(5)">Created Date</th>
        </tr>   
      </thead>

      <tbody>
        @foreach($data as $advertisement)
          <tr class="data-cell">
            <td class="0 tooltipped" data-tooltip="{{ $advertisement->course_id }}">{{ $advertisement->course_id }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $advertisement->title }}">{{ $advertisement->title }}</td>
            <td class="1 tooltipped" data-tooltip="{{ $advertisement->detail }}">{{ $advertisement->detail }}</td>
            <td class="2 tooltipped" data-tooltip="{{ $advertisement->course->title }}">{{ $advertisement->course->title }}</td>
            <td class="2"><a href="{{ url('/') }}/{{ $advertisement->course->cover_image }}" target="_blank">Link</a></td>
            <td class="2 tooltipped" data-tooltip="{{ $advertisement->created_at }}">{{ $advertisement->created_at }}</td>
            <input type="hidden" name="_course_id" value="{{ $advertisement->course_id }}">
            <input type="hidden" name="_title" value="{{ $advertisement->title }}">
            <input type="hidden" name="_detail" value="{{ $advertisement->detail }}">
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{--  MODAL BOX EDIT ADV  --}}
  <div id="modal2" class="modal" style="width:650px;">
    <div class="modal-content">
      <h4 class="center-align">Edit Advertisement</h4>
      <form method="POST" action="{{ url('/') }}/advertisement">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <input type="hidden" name="course_id">

        <div class="input-field col">
          <label for="title" class="active">Title</label>
          <input type="text" name="title" class="validate" data-length="100">
        </div>

        <div class="input-field col">
          <label for="detail" class="active">Detail</label>
          <input type="text" name="detail" class="validate" data-length="500">
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
      <form method="POST" action="{{ url('/') }}/advertisement">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="hidden" name="course_id">

        <div class="center-align">
          <button type="submit" style="margin-bottom:10px; width:255px;" 
            class="btn red waves-effect delete-adv-btn">
            DELETE
          </button> 
        </div>
      </form>
    </div>
  </div>

  {{--  MODAL BOX CREATE ADV  --}}
  <div id="modal3" class="modal" style="width:650px;">
    <div class="modal-content">
      <h4 class="center-align">Create Advertisement</h4>
      <form method="POST" action="{{ url('/') }}/advertisement">
        {{ csrf_field() }}

        <div class="input-field col">
          <label for="title" class="active">Title</label>
          <input type="text" name="title" class="validate" data-length="100">
        </div>

        <div class="input-field col">
          <label for="detail" class="active">Detail</label>
          <input type="text" name="detail" class="validate" data-length="500">
        </div>

        <div class="input-field col">
          <label for="course_id" class="active" style="width:100%">Course ID</label>
          <input type="text" name="course_id" class="validate" data-length="10">
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

      // MODAL CREATE ADV TRIGGER
      $('.modal-create-adv-btn').on('click', function(e){
        e.preventDefault();
        $('#modal3').modal('open');
        
        $("input[name='title']").val('');
        $("input[name='detail']").val('');
        $("input[name='course_id']").val('');

        $("input[name='title']").focus();
      });

      // MODAL EDIT ADV TRIGGER
      $('tr.data-cell').on('click', function(e){
        $('#modal2').modal('open');
        var course_id = $(this).find("input[name='_course_id']").val()
        var title = $(this).find("input[name='_title']").val()
        var detail = $(this).find("input[name='_detail']").val()

        $("input[name='course_id']").val(course_id);
        $("input[name='title']").val(title);
        $("input[name='detail']").val(detail);

        $("input[name='title']").focus();
        $("input[name='detail']").focus();
      });

      // CONFIRM DELETE ADV
      $('.delete-adv-btn').on('click', function(e){
        if(! confirm('Are you sure you want to delete this advertisement?'))
          e.preventDefault();
      });

    });
  </script>

@endsection