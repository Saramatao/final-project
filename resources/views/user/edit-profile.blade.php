@extends('user.template-edit')

@section('user-edit')

  <div class="col s9">
    <div class="center-align">
      <h4>แก้ไขข้อมูลโปรไฟล์สาธารณะ</h4>
    </div>
  </div> 

  <div class="col s9">
    <div class="container">

      <form role="form" method="POST" action="/user/edit-profile">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        {{--  NAME  --}}
        <div class="input-field col s12">
          <input id="first_name" name="first_name" type="text" data-length="50"
            class="validate" style="margin-bottom:0;" value="{{ $data->name }}">
          <label class="active" for="first_name">ชื่อ</label>
        </div>
        <div class="first_name error-msg col s12 red" style="display:none;"></div>

        {{--  LASTNAME  --}}
        <div class="input-field col s12">
          <input id="last_name" name="last_name" type="text" data-length="50"
            class="validate" style="margin-bottom:0;" value="{{ $data->last_name }}">
          <label class="active" for="last_name">นามสกุล</label>
        </div>
        <div class="last_name error-msg col s12 red" style="display:none;"></div>

        {{--  HEADLINE  --}}
        <div class="input-field col s12">
          <input id="headline" name="headline" type="text" data-length="50"
            class="validate" style="margin-bottom:0;" value="{{ $data->student->headline }}">
          <label class="active" for="headline">หน้าที่การงาน</label>
        </div>
        <div class="headline error-msg col s12 red" style="display:none;"></div>

        {{--  BIOGRAPHY  --}}
        <div class="input-field col s12">
          <textarea id="biography" name="biography" data-length="1000"
            class="materialize-textarea" style="margin-bottom:0;">{{ $data->student->biography }}</textarea>
          <label class="active" for="biography">ประวัติโดยย่อ</label>
        </div>
        <div class="biography error-msg col s12 red" style="display:none;"></div>

        @if ($data->instructor !== null)
          {{--  WEBSITE  --}}
          <div class="input-field col s12">
            <input id="website" name="website" type="text" data-length="50"
              class="validate" style="margin-bottom:0;"  value="{{ $data->instructor->website }}">
            <label class="active" for="website">เว็บไซต์ส่วนตัว</label>
          </div>
          <div class="website error-msg col s12 red" style="display:none;"></div>

          {{--  TWITTER  --}}
          <div class="col s12" style="margin-top:5px;">
            <table style="margin:0; padding:0;">
              <tr style="margin:0; padding:0;">
                <td style="width:100px;">
                  <div style="margin-top:12px; color:grey">https://twitter.com/</div>
                </td>

                <td style="margin:0; padding:0;">
                  <div class="input-field">
                    <input id="twitter" name="twitter" type="text" data-length="50"
                      class="validate" style="margin-bottom:0;" value="{{ $data->instructor->twitter }}">
                    <label class="active" for="twitter">Twitter Profile</label>
                  </div>
                  <div class="twitter error-msg col s12 red" style="display:none;"></div>
                </td>
              </tr>
            </table>
          </div>

          {{--  FACEBOOK  --}}
          <div class="col s12" style="margin-top:5px;">
            <table style="margin:0; padding:0;">
              <tr style="margin:0; padding:0;">
                <td style="width:100px;">
                  <div style="margin-top:12px; color:grey">https://www.facebook.com/</div>
                </td>

                <td style="margin:0; padding:0;">
                  <div class="input-field">
                    <input id="facebook" name="facebook" type="text" data-length="50" 
                      class="validate" style="margin-bottom:0;" value="{{ $data->instructor->facebook }}">
                    <label class="active" for="facebook">Facebook Profile</label>
                  </div>
                  <div class="facebook error-msg col s12 red" style="display:none;"></div>
                </td>
              </tr>
            </table>
          </div>

          {{--  LINKEDIN  --}}
          <div class="col s12" style="margin-top:5px;">
            <table style="margin:0; padding:0;">
              <tr style="margin:0; padding:0;">
                <td style="width:100px;">
                  <div style="margin-top:12px; color:grey">https://www.linkedin.com/</div>
                </td>

                <td style="margin:0; padding:0;">
                  <div class="input-field">
                    <input id="linkedin" name="linkedin" type="text" data-length="50"
                      class="validate" style="margin-bottom:0;" value="{{ $data->instructor->linkedin }}">
                    <label class="active" for="linkedin">Linkedin Profile</label>
                  </div>
                  <div class="linkedin error-msg col s12 red" style="display:none;"></div>
                </td>
              </tr>
            </table>
          </div>

          {{--  YOUTUBE  --}}
          <div class="col s12" style="margin-top:5px;">
            <table style="margin:0; padding:0;">
              <tr style="margin:0; padding:0;">
                <td style="width:100px;">
                  <div style="margin-top:12px; color:grey">https://www.youtube.com/</div>
                </td>

                <td style="margin:0; padding:0;">
                  <div class="input-field">
                    <input id="youtube" name="youtube" type="text" data-length="50" 
                      class="validate" style="margin-bottom:0;" value="{{ $data->instructor->youtube }}">
                    <label class="active" for="youtube">Youtube Channel</label>
                  </div>
                  <div class="youtube error-msg col s12 red" style="display:none;"></div>
                </td>
              </tr>
            </table>
          </div>

          {{--  GITHUB  --}}
          <div class="col s12" style="margin-top:5px;">
            <table style="margin:0; padding:0;">
              <tr style="margin:0; padding:0;">
                <td style="width:100px;">
                  <div style="margin-top:12px; color:grey">https://github.com/</div>
                </td>

                <td style="margin:0; padding:0;">
                  <div class="input-field">
                    <input id="github" name="github" type="text" data-length="50"
                      class="validate" style="margin-bottom:0;" value="{{ $data->instructor->github }}">
                    <label class="active" for="github">GitHub Repository</label>
                  </div>
                  <div class="github error-msg col s12 red" style="display:none;"></div>
                </td>
              </tr>
            </table>
          </div>
        @endif
        
        {{--  SUBMIT BUTTON  --}}
        <div class="center-align">
          <button type="submit" style="margin-top:25px; margin-right:10px; margin-bottom: 25px;" class="btn btn-submit">
            บันทึก
          </button> 
        </div>

      </form>

    </div>
  </div> 

  {{--  AJAX REQUEST  --}}
  <script type="text/javascript">
    $(document).ready(function() {

      $(".btn-submit").click(function(e){
        e.preventDefault();
        var form = $(this).parents("form");
        ajaxFormRequest(form, function(result) {console.log(result);}, {
          method:"PATCH", 
          action:`{{ url('/') }}/user/edit-profile` 
        });
      });

    });
  </script>

@endsection