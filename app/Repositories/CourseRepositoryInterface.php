<?php

namespace App\Repositories;

interface CourseRepositoryInterface 
{
	public static function all();

	public static function find($id);

  public static function getIdBySlug($slug);
  
  public static function checkOwner($user_id, $course_id);

	public static function distinctLecture($course);

	public static function countLecture($data);

	public static function _page_index();

	public static function _page_view($slug);

	public static function _learn_dashboard($slug, $user_id);
}