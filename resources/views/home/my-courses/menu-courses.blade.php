{{--  TAB CONTENT BOX  --}}
<div class="row tablet-container" style="margin-bottom: 0px; margin-top: -48px;">

  {{--  TAB MENU  --}}
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a href="#test1">คอร์สเรียนทั้งหมด</a></li>
      <li class="tab col s3"><a href="#test2">หมวดหมู่คอลเลคชั่น</a></li>
      <li class="tab col s3"><a href="#wishlist">คอร์สเรียนที่อยากได้</a></li>
      <li class="tab col s3"><a href="#test4">สำเร็จการศึกษา</a></li>
    </ul>
  </div>

  {{--  1ST TAB ALL COURSES --}}
  @include('home.my-courses.tab-all-courses')

  {{--  2ND TAB COLLECTIONS --}}
  @include('home.my-courses.tab-collections')

  {{--  3RD TAB WISHLIST --}}
  @include('home.my-courses.tab-wishlist')

  {{--  4TH TAB COMPLETED --}}
  @include('home.my-courses.tab-completed')

  {{--  5TH TAB ARCHIVED --}}
  {{--  @include('home.tab-archived')  --}}
  
</div>