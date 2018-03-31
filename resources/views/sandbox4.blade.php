<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Prompt' rel='stylesheet'>

  
  <link rel="stylesheet" href="/css/materialize.min.css"> 
  <link rel="stylesheet" href="/css/custom.css"> 
  
  
  <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="/js/ajax-image.js"></script>
  <script type="text/javascript" src="/js/materialize.min.js"></script>
  <script type="text/javascript" src="/js/init.js"></script>  
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <style>
    .add-vdo-btn, .add-pdf-btn, .add-txt-btn {
      margin-left:15%;
      border-bottom:1px solid grey;
    }

    .add-vdo-btn:hover, .add-pdf-btn:hover, .add-txt-btn:hover {
      cursor: pointer;
      border-bottom:1px solid black;
    }
  </style>

</head>
<body id="angularApp" ng-controller='CoursesController'>

  <ul ng-repeat="section in course.section">
    <li >
      <input type="text" ng-model="section.title" style="font-size:2em;">
    </li>
    <ul>
      <li ng-repeat="lecture in section.lecture">
        <input type="text" ng-model="lecture.title">
      </li>
    </ul>
  </ul>

  <input ng-model="firstname">
  <hr>

    <div class="col s9">
      <div class="center-align">
        <h4>เนื้อหาบทเรียน</h4>
      </div>

      <fieldset ng-repeat="section in course.section">
        <legend> @{{ section.title }}</legend>
        <form method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="_method">
          <input ng-model="section.sub_number" type="hidden" name="section_sub_number">

          <div class="input-field col s12">
            <input ng-model="section.title" name="title" type="text" data-length="50"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="title">ชื่อหัวข้อ</label>
          </div>

          <div class="input-field col s12">
            <input ng-model="section.objective" name="objective" type="text" data-length="50"
              class="validate" style="margin-bottom:0;">
            <label class="active" for="objective">จุดมุ่งหมาย</label>
          </div>
          
          <div class="center-align">
            <div class="btn save-sec-btn teal mar-top-25 mar-bot-25">บันทึก</div>
            <div class="btn del-sec-btn red mar-top-25 mar-bot-25">ลบทิ้ง</div>
          </div>
        </form>

        <div class="divider mar-bot-25"></div>
      
          <div ng-repeat="lecture in section.lecture">
            <form method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method">
              <input ng-model="lecture.id" type="hidden" name="lecture_id">

              <div style="display:flex;">
                <div class="input-field col s6">
                  <input ng-model="lecture.title" name="title" type="text" data-length="50"
                    class="validate" style="margin-bottom:0;">
                  <label class="active" for="title">ชื่อบทเรียน</label>
                </div>
              
                <div class="col s6 mar-top-10">
                  <div style="color: #888">
                    ประเภทบทเรียน :
                    <div ng-if="lecture.content_type == 'TXT'">
                      บทความ
                      <a href="{{ url('/') }}/course/@{{ course.id }}/preview/@{{ lecture.id }}">preview</a>
                    </div>
                    <div ng-if="lecture.content_type == 'PDF'">
                      สไลด์
                      <a href="{{ url('/') }}/course/@{{ course.id }}/preview/@{{ lecture.id }}">preview</a>
                    </div>
                    <div ng-if="lecture.content_type == 'VDO'">
                      วิดีโอ
                      <a href="{{ url('/') }}/course/@{{ course.id }}/preview/@{{ lecture.id }}">preview</a>
                    </div>
                    <div ng-if="lecture.content_type != 'TXT' && lecture.content_type != 'PDF' && lecture.content_type != 'VDO'">
                      ยังไม่มีบทเรียน
                    </div>
                  </div>

                  <input ng-model="lecture.status" ng-checked="lecture.status == 'FREE'" name="status" type="radio">
                  <label class="radio-btn">ดูฟรี</label>

                  <input ng-model="lecture.status" ng-checked="lecture.status == 'LOCKED'" name="status" type="radio">
                  <label class="radio-btn">ล้อค</label>
                  
                  <i class="material-icons save-lecture-btn mar-left-25" style="color:teal">save</i>
                  <i class="material-icons del-lecture-btn" style="color:red">delete</i>
                  <input ng-model="section.sub_number" type="hidden" name="section_sub_number">
                </div>
              </div>
            </form>

              <div ng-if="lecture.content_type == 'VDO'">
                <span class="add-vdo-btn bold w20">เปลี่ยนวีดีโอ</span>
                <span class="add-pdf-btn w20">แทนที่ด้วยสไลด์</span>
                <span class="add-txt-btn w20">แทนที่ด้วยบทความ</span>
              </div>
              <div ng-if="lecture.content_type == 'PDF'">
                <span class="add-pdf-btn bold w20">เปลี่ยนสไลด์</span>
                <span class="add-vdo-btn w20">แทนที่ด้วยวีดีโอ</span>
                <span class="add-txt-btn w20">แทนที่ด้วยบทความ</span>
              </div>
              <div ng-if="lecture.content_type == 'TXT'">
                <span class="add-txt-btn bold w20">แก้ไขบทความ</span>
                <span class="add-vdo-btn w20">แทนที่ด้วยวีดีโอ</span>
                <span class="add-pdf-btn w20">แทนที่ด้วยสไลด์</span>
              </div>
              <div ng-if="lecture.content_type != 'VDO' && lecture.content_type != 'PDF' && lecture.content_type != 'TXT'">
                <span class="add-vdo-btn w20">เพิ่มวีดีโอ</span>
                <span class="add-pdf-btn w20">เพิ่มสไลด์</span>
                <span class="add-txt-btn w20">เขียนบทความ</span>
              </div>

            <form id="@{{ lecture.id }}" enctype="multipart/form-data" class="lecture-content-vdo hide">
              {{ csrf_field() }}
              <input ng-model="lecture.id" type="hidden" name="lecture_id">
              <input type="hidden" name="content_type" value="VDO">
              <div class="center-align mar-top-25 mar-bot-25">อัพโหลดวีดีโอ</div>

              <input type="file" class="vdo btn">
              <input type="button" class="uploader-btn btn" value="อัพโหลด">
              <progress class="progressBar" value="0" max="100" style="width:300px;"></progress>
              <div class="status"></div>
              <div class="loaded_n_total"></div>
              <div class="list"></div>
            </form>

            <form id="@{{ lecture.id }}" enctype="multipart/form-data" class="lecture-content-pdf hide">
              {{ csrf_field() }}
              <input ng-model="lecture.id" type="hidden" name="lecture_id">
              <input type="hidden" name="content_type" value="PDF">
              <div class="center-align mar-top-25 mar-bot-25">อัพโหลดสไลด์</div>

              <input type="file" class="pdf btn">
              <input type="button" class="uploader-btn btn" value="อัพโหลด">
              <progress class="progressBar" value="0" max="100" style="width:300px;"></progress>
              <div class="status"></div>
              <div class="loaded_n_total"></div>
              <div class="list"></div>
            </form>

            <form id="@{{ lecture.id }}" method="POST" class="lecture-content-txt hide">
              {{ csrf_field() }}
              <input ng-model="lecture.id" type="hidden" name="lecture_id">
              <input type="hidden" name="content_type" value="TXT">
              <div class="center-align mar-top-25">อัพโหลดบทความ</div>
              
              <div class="input-field col s12">
                <textarea name="lecture_text"
                  class="materialize-textarea" style="margin-bottom:0;">@{{ lecture.content_text }}</textarea>
                <label class="active" for="lecture_text">บทความ</label>
              </div>

              <div class="center-align">
                <div class="btn save-lecture-text-btn mar-top-25">บันทึก</div>
              </div>
            </form>
          </div>

          <div class="divider mar-top-25 mar-bot-25"></div>

        <div class="lecture-content mar-bot-25"></div>
        <a class="add-lecture btn col offset-s5 mar-bot-25">
          <i class="material-icons left">note_add</i>
          เพิ่มบทเรียน
        </a>
        <input ng-model="section.sub_number" type="hidden" name="section_sub_number">
      </fieldset>
    
    </div>

  <script type="text/javascript" src="/lib/angular/angular.min.js"></script>

  <script type="text/javascript" src="/angular/modules/courses/courses.module.js"></script>
  <script type="text/javascript" src="/angular/modules/courses/controllers/courses.controller.js"></script>

  <script type="text/javascript" src="/angular/application.js"></script>
  
</body>
</html>