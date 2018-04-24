<nav class="teal lighten-1" role="navigation" >
  <div class="nav-wrapper">

    <ul>
      <li>
        <a href="/">กลับสู่เว็บไซต์</a> 
      <li>
    </ul> 
    
    <ul class="right">
      <li>
        <a href="{{ url('/') }}/admin/courses">คอร์สเรียน</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/promotions">โปรโมชั่น</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/students">ผู้เรียน</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/instructors">ผู้สอน</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/categories">หมวดหมู่คอร์สเรียน</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/advertisements">โฆษณา</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/transaction">ประวัติการชำระเงิน</a>
      </li>
      <li>
        <a href="{{ url('/') }}/admin/abusereport">รายงานการละเมิด</a>
      </li>
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          ออกจากระบบ
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
    </ul> 
  </div>
</nav>
