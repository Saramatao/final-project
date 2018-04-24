<div class="teal" style="height:150px; margin-bottom: 0px;">
  <div class="row container"> 
    <div class="col s12">
      
      <div class="col 12" style="height:25px; width:100%;"></div>

      <div class="col s5">
        <span style="font-size: 2em;">แผงควบคุมการสอน</span>
      </div>

      <div class="btn waves-effect modal-trigger course-modal-trigger" href="#modal1">
        สร้างคอร์สเรียน
      </div>

      <a class="btn waves-effect" href="/home/teaching/transaction">
        ประวัติการขายคอร์สเรียน
      </a>

      {{--  MODAL BOX  --}}
      <div id="modal1" class="modal">
        <div class="modal-content">
          <form>
            {{ csrf_field() }}
            <h4>สร้างคอร์สเรียน</h4>

            <div class="input-field col s12 mar-bot-25">
              <input name="title" type="text" data-length="50"
                class="validate" style="margin-bottom:0;">
              <label class="active" for="title">ชื่อคอร์สเรียน</label>
            </div>
            
            <div class="center-align">
              <button type="submit" class="btn btn-submit">
                ยืนยัน
              </button> 
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">ปิดหน้าต่าง</a>
        </div>
      </div>

    </div>
  </div> 
</div> 

<script type="text/javascript">
  $(document).ready(function() {

    $('form').submit(function(e) {
      e.preventDefault();
    
      ajaxFormRequest($(this), function(response){
          // alert(response.success);
          var course_id = response.course_id;
          window.location.replace("{{ url('/') }}/course/" + course_id + "/title")
      }, {"method":"POST", "action":`{{ url('/') }}/course` });
    });

  });
</script>
