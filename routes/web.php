<?php

Route::get('/', 															'PagesController@index');
Route::get('/view/{slug}', 										'PagesController@view');
Route::get('/preview-lecture/{lecture_id}',   'PagesController@previewLecture');

Route::get('/search', 												'PagesController@searchPage');
Route::get('/search/{name}', 									'PagesController@search');
Route::post('/search', 												'PagesController@searchForm');

// LEARN DASHBOARD
Route::get('/learn/{slug}/dashboard', 				'LearnController@dashboard');
Route::get('/learn/{slug}/lecture/{lecture}', 'LearnController@lecture');

Route::post('/review',											  'LearnController@saveReview');

Route::post('/question',											'LearnController@createQuestion');
Route::patch('/question',											'LearnController@updateQuestion');
Route::delete('/question',										'LearnController@deleteQuestion');

Route::post('/answer',												'LearnController@createAnswer');
Route::patch('/answer',												'LearnController@updateAnswer');
Route::delete('/answer',											'LearnController@deleteAnswer');

Route::get('/bookmarks',        			        'BookmarksController@getBookmarks');
Route::post('/bookmarks',        			        'BookmarksController@createBookmarks');
Route::put('/bookmarks',        			        'BookmarksController@updateBookmarks');
Route::delete('/bookmarks',                   'BookmarksController@deleteBookmarks');

// MY COURSE
Route::get('/home/my-courses', 								'HomeController@myCourses');
Route::get('/home/teaching', 								  'HomeController@teaching');
Route::get('/home/teaching/transaction', 			'HomeController@transaction');
Route::post('/course',                        'CoursesController@createCourse');

Route::post('/collection', 								    'CollectionsController@createCollection');
Route::patch('/collection', 								  'CollectionsController@updateCollection');
Route::delete('/collection', 								  'CollectionsController@deleteCollection');
Route::delete('/collectiondetail', 						'CollectionsController@deleteCollectionDetail');
Route::post('/collectiondetail', 						  'CollectionsController@editCollectionDetail');
Route::get('/collection/{id}/detail', 			  'CollectionsController@getCollectionDetail');

Route::post('/wishlist',											'WishlistsController@createWishlist');
Route::delete('/wishlist',										'WishlistsController@deleteWishlist');

// COURSE MANAGEMENT
Route::get('/course/{course_id}/title',       'CoursesController@editTitle');
Route::patch('/course/title',                 'CoursesController@updateTitle');
Route::patch('/course/image',                 'CoursesController@updateImage');

Route::get('/course/{course_id}/detail',      'CoursesController@editDetail');
Route::post('/course/target',                 'CoursesController@saveTarget');
Route::post('/course/benefit',                'CoursesController@saveBenefit');
Route::post('/course/prerequisite',           'CoursesController@savePrerequisite');

Route::get('/course/{course_id}/price-coupon','CoursesController@editPriceCoupon');
Route::post('/course/price',                  'CoursesController@savePrice');
Route::post('/course/coupon',                 'CoursesController@createCoupon');

Route::get('/course/{course_id}/cirriculum',  'CoursesController@editCirriculum');
Route::post('/course/section',                'CoursesController@saveSection');
Route::delete('/course/section',              'CoursesController@deleteSection');
Route::post('/course/lecture',                'CoursesController@saveLecture');
Route::delete('/course/lecture',              'CoursesController@deleteLecture');
Route::post('/course/lecture-vdo',            'CoursesController@saveLectureVdo');
Route::post('/course/lecture-pdf',            'CoursesController@saveLecturePdf');
Route::post('/course/lecture-txt',            'CoursesController@saveLectureTxt');
Route::patch('/course/license',               'CoursesController@saveLicense');

Route::get('/course/{course_id}/setting',     'CoursesController@editSetting');
Route::post('/course/{course_id}/setting',    'CoursesController@updateSetting');
Route::delete('/course/{course_id}/delete',   'CoursesController@deleteCourse');

Route::get('/course/{course_id}/preview/{lecture_id}',  'CoursesController@previewLecture');

// USER MANAGEMENT
Route::get('/user/edit-profile',        			'UsersController@editProfile');
Route::get('/user/edit-image',          			'UsersController@editImage');
Route::get('/user/edit-account',        			'UsersController@editAccount');
Route::get('/user/edit-password',       			'UsersController@editPassword');
Route::get('/user/edit-privacy',        			'UsersController@editPrivacy');
Route::get('/user/edit-notification',   			'UsersController@editNotification');

Route::patch('/user/edit-profile',      			'UsersController@updateProfile');
Route::patch('/user/edit-image',        			'UsersController@updateImage');
Route::patch('/user/edit-account',      			'UsersController@updateAccount');
Route::patch('/user/edit-password',     			'UsersController@updatePassword');
Route::patch('/user/edit-privacy',      			'UsersController@updatePrivacy');
Route::patch('/user/edit-notification', 			'UsersController@updateNotification');
Route::get('/user/purchase-details',          'UsersController@getUserPurchaseDetails');

Route::get('/become-instructor', 							'PagesController@becomeInstructor');
Route::post('/become-instructor',        			'UsersController@becomeInstructor');

Route::get('/read-noti/{noti_id}',            'UsersController@readNoti');
Route::get('/all-noti',                       'UsersController@allNoti');
Route::get('/read-all-noti',                  'UsersController@readAllNoti');

// ADMIN AUTH
Route::get('/admin', 													'AdminsController@index');
Route::get('/admin/login', 										'AdminsController@login');
Route::post('/admin/login', 									'Auth\LoginController@login');

// ADMIN MANAGEMENT
Route::get('/admin/courses', 									'AdminsController@courses');
Route::get('/admin/courses-pending', 					'AdminsController@coursesPending');
Route::get('/admin/courses/{course_id}', 			'AdminsController@courseDetail');
Route::get('/admin/promotions', 							'AdminsController@promotions');
Route::get('/admin/students', 								'AdminsController@students');
Route::get('/admin/instructors', 							'AdminsController@instructors');
Route::get('/admin/categories', 							'AdminsController@categories');
Route::get('/admin/advertisements', 					'AdminsController@advertisements');
Route::get('/admin/purchase', 								'AdminsController@purchase');
Route::get('/admin/abusereport', 							'AdminsController@abusereport');
Route::get('/admin/transaction',              'AdminsController@transaction');

Route::post('/admin/courses', 								'AdminsController@searchCourses');
Route::post('/admin/promotions', 							'AdminsController@searchPromotions');
Route::post('/admin/students', 								'AdminsController@searchStudents');
Route::post('/admin/instructors', 						'AdminsController@searchInstructors');
Route::post('/admin/categories', 							'AdminsController@searchCategories');
Route::post('/admin/advertisements', 					'AdminsController@searchAdvertisements');
Route::post('/admin/purchase', 								'AdminsController@searchPurchase');
Route::post('/admin/abusereport', 						'AdminsController@searchAbusereport');

Route::post('/promotion', 						      	'PromotionsController@createPromotion');
Route::patch('/promotion', 						      	'PromotionsController@updatePromotion');

Route::post('/category',											'CategoriesController@createCategory');
Route::patch('/category',											'CategoriesController@updateCategory');
Route::delete('/category',										'CategoriesController@deleteCategory');

Route::post('/advertisement',									'AdvertisementController@createAdvertisement');
Route::patch('/advertisement',								'AdvertisementController@updateAdvertisement');
Route::delete('/advertisement',								'AdvertisementController@deleteAdvertisement');

// PAYMENT
Route::get('/cart',                           'PurchaseController@cart');
Route::post('/cart',                          'PurchaseController@cartAddCourse');
Route::delete('/cart',                        'PurchaseController@cartRemoveCourse');
Route::get('/checkout', 								      'PurchaseController@checkout');
Route::post('/checkout', 								      'PurchaseController@paypalFinishTransaction');
Route::get('/complete', 								      'PurchaseController@completedMessage');

// USER AUTH
Route::post('/paypal/confirm', 								'PurchaseController@paypalPDT');
Route::post('/login/manual', 								  'CustomAuthController@manualLogin');
Route::post('/register/manual', 							'CustomAuthController@manualRegister');

// API
Route::get('/api/courses/{course_id}',        'ApiController@getCourse');

// FILES ACCESS
Route::get('lectures/{filename}', 						'FilesController@getLecture')
	->where('filename', '^[^/]+$');
Route::get('avatars/{filename}', 							'FilesController@getAvatar')
	->where('filename', '^[^/]+$');
Route::get('cover_images/{filename}', 				'FilesController@getCoverImage')
  ->where('filename', '^[^/]+$');

// 404 PAGE
Route::get('/page-not-found', function () { return view('page-not-found'); })
	->name('invalid-url');;

// ==========================================================================
// ==========================================================================

Route::get('/testsandbox',    								'PurchaseController@sandbox');
Route::get('/sandbox', function () { return view('sandbox'); });
Route::get('/sandbox2', function () { return view('sandbox2'); });
Route::get('/sandbox3', function () { return view('sandbox3'); });
Route::get('/sandbox4', function () { return view('sandbox4'); });
Route::get('/mapper', function () { return view('mapper'); });
// Route::get('/upvdo/{lecture}', 								'LearnController@upvdo');
// Route::post('/upvdo/{lecture}', 							'LearnController@upvdo');
// Route::post('/upvdo', 												'LearnController@upvdo');

Route::get('users', 'UsersController@index');

Auth::routes();

