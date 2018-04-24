<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\UserEditProfileRequest;
use App\Http\Requests\UserEditAccountRequest;
use App\Http\Requests\UserEditPasswordRequest;
use Validator;
use App\Models\User;
use App\Models\Notification;

use Illuminate\Support\Facades\Auth;

use App\Services\UserService;

class UsersController extends Controller
{
  protected $userService;

  public function __construct(UserService $userService)
  {
    $this->middleware('auth');
    $this->userService = $userService;
  }

  public function index()
  {
    if (Auth::user())  
      return Auth::user();

    return 'nope';
  }

  // EDIT FORM ===============================================
  // EDIT FORM ===============================================

  public function editProfile()
  { 
    $data = $this->userService->getUser(Auth::user()->id);

    return view('user/edit-profile')
      ->with('data', $data);
  }

  public function editImage()
  { 
    $data = $this->userService->getUser(Auth::user()->id);

    return view('user/edit-image')
      ->with('data', $data);
  }

  public function editAccount()
  {
    $data = $this->userService->getUser(Auth::user()->id);

    return view('user/edit-account')
      ->with('data', $data);
  }

  public function editPassword()
  {
    $data = $this->userService->getUser(Auth::user()->id);

    return view('user/edit-password')
      ->with('data', $data);
  }

  public function editPrivacy()
  {
    $data = $this->userService->getUser(Auth::user()->id);

    return view('user/edit-privacy')
      ->with('data', $data);
  }

  public function editNotification()
  {
    $data = $this->userService->getUser(Auth::user()->id);

    return view('user/edit-notification')
      ->with('data', $data);
  }

  // PATCH REQUEST ===============================================
  // PATCH REQUEST ===============================================

  public function updateProfile(Request $request)
  { 
    $rules = [
      'first_name' => 'min:3|max:50',
      'last_name' => 'max:50|alpha|nullable',
      'headline' => 'max:50',
      'biography' => 'max:1000',
      'website' => 'max:50',
      'twitter' => 'max:50',
      'facebook' => 'max:50',
      'linkedin' => 'max:50',
      'youtube' => 'max:50',
      'github' => 'max:50'
    ];

    $messages = [
      'first_name.min' => 'ชื่อต้องมีความยาวอย่างน้อย 3 - 50 ตัวอักษร',
      'first_name.max' => 'ชื่อต้องมีความยาวอย่างน้อย 3 - 50 ตัวอักษร',
      'last_name.alpha' => 'นามสกุลต้องประกอบด้วยตัวอักษรเท่านั้น',
      'last_name.max' => 'นามสกุลต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'headline.max' => 'หน้าที่การงานต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'biography.max' => 'ประวัติโดยย่อต้องมีความยาวไม่เกิน 1000 ตัวอักษร',
      'website.max' => 'เว็บไซต์ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'twitter.max' => 'Twitter ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'facebook.max' => 'Facebook ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'linkedin.max' => 'LinkedIn ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'youtube.max' => 'Youtube ต้องมีความยาวไม่เกิน 50 ตัวอักษร',
      'github.max' => 'GitHub ต้องมีความยาวไม่เกิน 50 ตัวอักษร'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails())
      return response()->json(['error'=>$validator->errors()]);

    $this->userService->updateProfile(Auth::user()->id, $request);
    return response()->json(['success' => 'request succeed, profile updated']);
  }

 
  public function updateImage(ImageUploadRequest $request)
  { 
    // if ($request->hasFile('photo'))
    // {
      // return "file present !!!!!!!";
    $filename = $this->userService->updateImage(Auth::user()->id, $request);
    // }
    // else{
        // return "file not present";
    // }

    // return redirect('/user/edit-image');

    return response()->json(['success' => $filename]);
  }

  public function updateAccount(UserEditAccountRequest $request)
  {
    $errors = $this->userService->updateAccount(Auth::user()->id, $request);

    if ( count($errors) > 0)
      return response()->json(['error' => $errors]);

    $data = $this->userService->getUser(Auth::user()->id);

    return response()->json(['success' => $data->email]);
  }

  public function updatePassword(UserEditPasswordRequest $request)
  {
    $isSuccess = $this->userService->updatePassword(Auth::user()->id, $request);

    if (! ($isSuccess))
      return response()->json(['error' =>  ['current_password' => ['รหัสผ่านไม่ถูกต้อง']]]);

    return response()->json(['success' => 'request succeed']);
  }

  public function updatePrivacy(Request $request)
  {
    $this->userService->updatePrivacy(Auth::user()->id, $request);

    return response()->json(['success' => 'request succeed']);
  }

  public function updateNotification(Request $request)
  {
    $this->userService->updateNotification(Auth::user()->id, $request);

    return response()->json(['success' => 'request succeed']);
  }

  public function getUserPurchaseDetails()
  {
    $user = User
      ::with('purchase', 'purchase.purchasedetail', 'purchase.purchasedetail.course')
      ->where('id', Auth::user()->id)
      ->first();

    return view('user/purchase-details')
      ->with('user', $user);
  }

  public function readNoti($noti_id)
  {
    $notification = Notification::find($noti_id);
    $redirect_url = $notification->link;

    $notification->status = 'READ';
    $notification->save();

    return redirect($redirect_url);
  }

  public function allNoti()
  {
    $notifications = Notification
      ::where('user_id', Auth::user()->id)
      ->where('status', 'UNREAD')
      ->orderBy('created_at', 'desc')
      ->get();

    return view('user/all-notification')
      ->with('notifications', $notifications);
  }

  public function readAllNoti()
  {
    $notifications = Notification
      ::where('user_id', Auth::user()->id)
      ->where('status', 'UNREAD')
      ->update(['status' => 'READ']);

    return redirect('/all-noti');
  }

  public function becomeInstructor(Request $request)
  {
    $user = User::find($request->user_id);

    if ($user->role == 1) {
      $user->role = 2;
      $user->save();
    } 

    return redirect('/');
  }
}

