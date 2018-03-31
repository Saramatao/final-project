{{--  TAB MENU  --}}
<div class="pc-container auto-margin" style="margin-bottom:25px;">
  <ul class="tabs">
    <li class="tab col s2 overview-tab"><a href="#overview">หน้าแรก</a></li>
    <li class="tab col s2 course-content-tab"><a href="#course-content">เนื้อหาบทเรียน</a></li>
    <li class="tab col s2 qa-tab"><a href="#qa">ถามตอบปัญหา</a></li>
    <li class="tab col s2 bookmarks-tab"><a href="#bookmarks">บุ๊กมาร์ก</a></li>
    <li class="tab col s2 announcements-tab"><a href="#announcements">ประกาศจากผู้สอน</a></li>
  </ul>
</div>

{{--  TAB CONTENT BOX  --}}
<div class="pc-container auto-margin" style="min-height:500px;">
  
  {{--  1ST TAB OVERVIEW --}}
  @include('learn.dashboard.tab-overview')

  {{--  2ND TAB COURSE CONTENT --}}
  @include('learn.dashboard.tab-course-content')

  {{--  1ST TAB Q&A --}}
  @include('learn.dashboard.tab-qa')

  {{--  1ST TAB BOOKMARKS --}}
  @include('learn.dashboard.tab-bookmarks')

  {{--  1ST TAB ANNOUNCEMENTS --}}
  @include('learn.dashboard.tab-announcements')

</div>
<script>
  $(document).ready(function(){

    $('#viewMoreQA').click(function(){ 
      $('ul.tabs').tabs('select_tab', 'qa');
      return false; 
    });

    $('#viewMoreAnnouncement').click(function(){ 
      $('ul.tabs').tabs('select_tab', 'announcements');
      return false; 
    });

    $('.overview-tab').click(function(e){ 
      window.location.href = "#overview";
    });

    $('.course-content-tab').click(function(e){ 
      window.location.href = "#course-content";
    });

    $('.qa-tab').click(function(e){ 
      window.location.href = "#qa";
    });

    $('.bookmarks-tab').click(function(e){ 
      window.location.href = "#bookmarks";
    });

    $('.announcements-tab').click(function(e){ 
      window.location.href = "#announcements";
    });
  });
</script>
