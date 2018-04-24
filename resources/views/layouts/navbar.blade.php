  <div class="navbar-fixed">
    <nav class="color-main" role="navigation" >
      <div class="nav-wrapper">

        {{--  LEFT ITEMS  --}}
        <ul>
          <li>
            <a href="/">Cool Course</a> 
          <li>
          {{-- <li>
            <a href="#"><i class="material-icons">view_list</i></a> 
          <li> --}}
          {{--  <li style="width:28%;height:50px; margin-top:5px;">   
            <form>
              <div class="input-field">
                <input id="search" type="search" required>
                <label style="margin-top:-18px;" class="label-icon" for="search">
                  <i class="material-icons">search</i>
                </label>
                <i style="margin-top:-7px;" class="material-icons">close</i>
              </div>
            </form>
          </li>  --}}
        </ul> 
        
        {{--  RIGHT ITEMS  --}}
        <ul class="right">
          @if (Auth::guest())
            <li>
              <a href="{{ url('/') }}/cart" class="nav-hover"><i class="material-icons">shopping_cart</i></a>
            </li>
            <li><a href="#login-modal" class="modal-trigger nav-hover">เข้าสู่ระบบ</a></li>
            <li><a href="#signup-modal" class="modal-trigger nav-hover">สมัครสมาชิก</a></li>
          @elseif (Auth::user()->role == 3)
            <li><a href="/admin/courses" class="modal-trigger nav-hover">แอดมิน</a></li>
          @else
            <li>
              <a href="{{ url('/') }}/cart" class="nav-hover"><i class="material-icons">shopping_cart</i></a>
            </li>
            <li>
              @if (Auth::user()->role == 2)
                <a href="{{ url('/') }}/home/teaching" class="nav-hover">
                  <i class="material-icons left">school</i> การสอน </a>
              @else
                <a href="{{ url('/') }}/become-instructor" class="nav-hover">
                  <i class="material-icons left">school</i> สอนกับเรา </a>
              @endif
            </li> 
            <li>
              <a href="{{ url('/') }}/home/my-courses" class="nav-hover">
                <i class="material-icons left">import_contacts</i> คอร์สเรียน </a>
            </li> 
            <li>
              <a href="{{ url('/') }}/home/my-courses#wishlist" class="nav-hover dropdown-button" data-activates="dropdown-nav-favorite">
                <i class="material-icons" class="nav-hover">favorite</i></a>
            </li>
            <li>
              <a href="{{ url('/') }}/all-noti" class="nav-hover dropdown-button" data-activates="dropdown-nav-notification">
                <i class="material-icons" class="nav-hover">notifications</i></a>
            </li>
            <li>
              <a href="{{ url('/') }}/user/edit-profile" style="padding-top:10px;" 
                class="dropdown-button" data-activates="dropdown-nav-profile">
                <img src="{{ url('/') }}/{{ Auth::user()->student->photo }}" alt="cover_image"
                  class="circle" style="width:40px; height:40px;">
              </a>
            </li>

            {{--  DROP DOWN CONTENT FAVORITE  --}}
            <ul id="dropdown-nav-favorite" class="dropdown-content" style="margin-top:64px; min-width:200px;">
              @foreach (Session::get('wishlist') as $wishlist)
                <li class="dash-hover">
                  <a href="{{ url('/') }}/view/{{ $wishlist->course->slug }}">
                    {{ $wishlist->course->slug }}
                  </a>
                </li>
              @endforeach
              <li class="dash-hover">
                <a href="{{ url('/') }}/home/my-courses#wishlist">ดูรายการโปรดทั้งหมด</a>
              </li>
            </ul>

            {{--  DROP DOWN CONTENT NOTIFICATION  --}}
            <ul id="dropdown-nav-notification" class="dropdown-content" style="margin-top:64px; min-width:200px;">
              @foreach (Auth::user()->lastThreeNotification as $noti)
                @if ($noti->status === 'UNREAD')
                  <li class="dash-hover">
                    <a href="{{ url('/') }}/read-noti/{{ $noti->id }}">{{ $noti->message }} <br>
                      เมื่อ {{ date('d/m/y', strtotime($noti->created_at)) }} <br>
                      เวลา {{ date('H:m A', strtotime($noti->created_at)) }} <br>
                    </a>
                  </li>
                @endif
              @endforeach
              <li class="dash-hover">
                <a href="{{ url('/') }}/all-noti"> ดูการแจ้งเตือนทั้งหมด</a>
              </li>
            </ul>
            
            {{--  DROP DOWN CONTENT PROFILE  --}}
            <ul id="dropdown-nav-profile" class="dropdown-content" style="margin-top:64px; min-width:200px;">
              <li class="dash-hover">
                <a href="#!">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</a>
              </li>
              <li class="dash-hover">
                <a href="{{ url('/') }}/user/edit-profile">แก้ไขข้อมูลส่วนตัว</a>
              </li>
              <li class="dash-hover">
                <a href="{{ url('/') }}/user/purchase-details">ประวัติการชำระเงิน</a>
              </li>
              <li class="divider"></li>
              <li class="dash-hover">
                <a href="{{ route('logout') }}" 
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  ออกจากระบบ
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            </ul>
          @endif
        </ul> 

        {{--  <ul id="nav-mobile" class="side-nav">
            <li><a href="#">Side Navbar Link</a></li>
        </ul>  --}}
        {{--  <a href="#" data-activates="nav-mobile" class="button-collapse">
          <i class="material-icons">menu</i></a>
      </div>  --}}
    </nav>
  </div>


  @if (Auth::guest())
    {{--  REGISTER MODAL --}}
    <div id="signup-modal" class="modal" style="width:350px; min-height:540px; overflow:hidden;">
      <div class="modal-content">
        <h4 class="center-align">สมัครสมาชิก</h4>

        {!! Form::open(['url' => '/register/manual', 'method' => 'POST', 'class'=>'register-form']) !!}
          {{ csrf_field() }}

          <div class="input-field col">
            <label for="name">ชื่อ - นามสกุล</label>
            <input name="name" type="text"  class="validate" data-length="100">
          </div>
          <div class="error-msg name red col s12" style="display:none"></div>
          
          <div class="input-field col">
            <label for="email" class="active">อีเมล์</label>
            <input name="email" type="email" class="validate" data-length="50">
          </div>
          <div class="error-msg email red col s12" style="display:none"></div>

          <div class="input-field col">
            <label for="password" class="active">รหัสผ่าน</label>
            <input name="password" type="password" class="validate" data-length="30">
          </div>
          <div class="error-msg password red col s12" style="display:none"></div>
          
          <div class="input-field col">
            <label for="password-confirm">ยืนยันรหัสผ่าน</label>
            <input id="password-confirm" type="password" class="validate" 
              name="password_confirmation" required>
          </div>

          <div style="width:300px; height:1px;"></div>
          <div class="error-msg password_confirmation red col s12" style="display:none"></div>   

          <div class="center-align">
            <button type="submit" style="width:255px;" 
              class="btn btn-submit waves-effect register-user-btn mar-top-25 mar-bot-10">
              สมัครสมาชิก
            </button> 
          </div>
        {!! Form::close() !!}

        {{--  FACEBOOK REGISTER  --}}
        <div style="padding-left:24px;">
          <fb:login-button class="fb-login-button" data-max-rows="1" data-size="large" 
            data-button-type="continue_with" data-show-faces="false" 
            data-auto-logout-link="false" data-use-continue-as="false"
            scope="public_profile, email" onlogin="checkRegisterState();">
          </fb:login-button>
        </div>

        {{--  GOOGLE REGISTER  --}}
        <div>
          <div class="g-signin2" data-height="38" data-width="255" 
            data-longtitle="true" data-theme="dark" data-onsuccess="onSignUp"
            style="margin-left:23px; margin-top:10px;"></div>
        </div>
      </div>

      <div class="modal-footer">
        <hr>
        <a href="#login-modal" 
          class="modal-trigger modal-action modal-close waves-effect waves-green btn-flat">
          เคยลงทะเบียนกับเราแล้ว ? 
          <span class="color-main-text">
            เข้าสู่ระบบที่นี่
          </span>
        </a>
      </div>
    </div>

    {{--  LOGIN MODAL  --}}
    <div id="login-modal" class="modal" style="width:350px; min-height:340px;">
      <div class="modal-content">
        <h4 class="center-align">เข้าสู่ระบบ</h4>

        {!! Form::open(['url' => '/login/manual', 'method' => 'POST', 'class'=>'login-form']) !!}
          {{ csrf_field() }}

          <div class="input-field col">
            <label for="email" class="active">อีเมล์</label>
            <input name="email" type="email" class="validate" data-length="50">
          </div>

          <div class="input-field col">
            <label for="password" class="active">รหัสผ่าน</label>
            <input name="password" type="password" class="validate" data-length="30">
          </div>

          <div style="width:300px; height:1px;"></div>
          <div class="error-msg form red col s12" style="display:none"></div>

          <div class="center-align">
            <button type="submit" style="margin-top:50px; margin-bottom:10px; width:255px;" 
              class="btn btn-submit login-user-btn waves-effect">
                เข้าสู่ระบบ
            </button> 
          </div>
        {!! Form::close() !!} 

        {{--  FACEBOOK LOGIN  --}}
        <div style="padding-left:24px;">
          <fb:login-button class="fb-login-button" data-max-rows="1" data-size="large" 
            data-button-type="continue_with" data-show-faces="false" 
            data-auto-logout-link="false" data-use-continue-as="false"
            scope="public_profile, email" onlogin="checkLoginState();">
          </fb:login-button>
        </div>

        {{--  GOOGLE REGISTER  --}}
        <div>
          <div class="g-signin2" data-height="38" data-width="255" 
             data-longtitle="true" data-theme="dark" data-onsuccess="onLogIn"
             style="margin-left:23px; margin-top:10px;"></div>
        </div>
      </div>

      <div class="modal-footer">
        <hr>
        <a href="#signup-modal" 
          class="modal-trigger modal-action modal-close waves-effect waves-green btn-flat">
            ยังไม่มีบัญชี ? 
          <span class="color-main-text">
            ลงทะเบียนที่นี่
          </span>
        </a>
      </div>
    </div>

    {{--  AJAX REQUEST  --}}
    <script type="text/javascript">
      $(document).ready(function() {
        
        // Register User
        $(document).on('click', '.register-user-btn', function(e) {
          e.preventDefault();
          var form = $(this).parents("form");
          ajaxFormRequest(form, function(response) {
            if (response !== false) window.location.href = "{{ url('/') }}";
          }, {
            method:"POST", 
            action:`{{ url('/') }}/register/manual` 
          });
        });

        // Login User
        $(document).on('click', '.login-user-btn', function(e) {
          e.preventDefault();
          var form = $(this).parents("form");
          ajaxFormRequest(form, function(response) {
            if (response !== false) window.location.href = "{{ url('/') }}";
          }, {
            method:"POST", 
            action:`{{ url('/') }}/login/manual` 
          });
        });

      });
    </script>
  @endif