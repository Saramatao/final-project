<!-- // $data = array(
//     'name'  => 'Raphael',
//     'age'   => 18,
//     'email' => 'r.mobis@rmobis.com'
// );
// return View::make('user')->with($data);
// return User::all();
// $users = DB::table('Courses');
// ->join('Users', 'Courses.id', '=', 'contacts.user_id')
// $data = array(
//   'title' => 'some value here'
// );
// $title = 'Welcome To Laravel';
// return view('index', compact('title'));
// return view('index')->with('title', $title);
// return Course::all()->join('contacts', 'users.id', '=', 'contacts.user_id')->get();
// return User::with('getCourses')->get();
// return Course::with('instructor')->get();
// return Course::with('instructor')->get(['id','title']);
// $reviewer = Course::with(
//   [
//     'review'=>function($query){$query
//       ->select('user_id', 'course_id');},
//     'review.user'=>function($query){$query
//       ->select('id', 'name', 'last_name');},
//     'review.user.student'=>function($query){$query
//       ->select('user_id','photo');},
//   ])
//   ->where('slug', '=', $slug)
//   ->select('id')
//   ->first()
//   ->review;
// $reviewer = Course::join('reviews', 'courses.id', '=', 'reviews.course_id')
//         ->join('users', 'reviews.user_id', '=', 'users.id')
//         ->join('students', 'users.id', '=', 'students.user_id')
//         ->where('courses.slug', '=', $slug)
//         ->select('name', 'last_name', 'photo')
//         ->get();
// foreach($course->review as $index=>$review){
//   $array = [
//     'name' =>$review->user->name, 
//     'last_name' => $review->user->last_name, 
//     'photo' => $review->user->student->photo
//   ];
//   array_push($reviewerss, $array);
// } -->


<!-- public function store(Request $request)
  {
    $this->validate($request, [
      'full_name' => 'required',
      'email' => 'required',
    ]);

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $id = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 10; $i++) 
      $id .= $characters[mt_rand(0, $max)];

    $user = new User;
    $user->id = $id;
    $user->name = $request->input('full_name');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->save();

    return redirect('/users');
  }

  $validator = Validator::make($request->all(), [
      'name' => 'between:3,50|alpha',
      'last_name' => 'max:50|alpha|nullable',
      'headline' => 'max:50',
      'biography' => 'max:1000'
    ], [
      'name.between' => 'ชื่อต้องมีความยาวอย่างน้อย 3 - 50 ตัวอักษร',
      'name.alpha' => 'ชื่อต้องประกอบด้วยตัวอักษรเท่านั้น',
      'last_name.alpha' => 'นามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น',
      'last_name.max' => 'นามสกุลต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'headline.max' => 'หน้าที่การงานต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'biography.max' => 'ประวัติโดยย่อต้องมีความยาวไม่เกิน 1000 ตัวอักษร'
    ]);

    if ($validator->fails()) 
      return response()->json(['error'=>$validator->errors()]);
 -->

 <!-- // if (response.success) {
//   $("form.form_target").html('');
//   $("form.form_target").append(`
//     {{ csrf_field() }}
//     <input type="hidden" name="course_id" value="{{ $data->id }}">
//   `);

//   $.each(response.success, function( key, value ) {
//     alert(value.detail);

//      $("form.form_target").html(``

//   });

//   $("form.form_target").html(`
  
//     <form role="form" class="form_target" method="POST" action="{{ url('/') }}/course/save-target">
//       {{ csrf_field() }}
//       <input type="hidden" name="course_id" value="{{ $data->id }}">

//       {{--  TARGET  --}}
  
//         <div class="input-field col s12">
//           {{ $target->sub_number }} 
//           <input name="target[]" type="text" data-length="100"
//             class="validate" style="margin-bottom:0;" value="{{ $target->detail }}">
//           <label class="active" for="target">กลุ่มเป้าหมาย</label>
//         </div>
//         <div class="target error-msg col s12 red" style="display:none;"></div>

//       <div class="target-content"></div>

//       <div class="center-align">
//         <div class="btn add-target">
//           Add Target
//         </div> 
//       </div>

//       {{--  SUBMIT BUTTON  --}}
//       <div class="center-align">
//         <button type="submit" class="btn btn-submit">
//           บันทึก
//         </button> 
//       </div>
//     </form>
//   `);
// } -->
