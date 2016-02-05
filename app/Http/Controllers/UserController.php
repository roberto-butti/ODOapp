<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ClipRepository;

use Auth;
use App\User;


class UserController extends Controller
{
  /**
   * The clip repository instance.
   *
   * @var ClipRepository
   */
  protected $clips;
  public $path_clip_upload ='/public/upload/clip/catalog/';
  public $url_clip_upload ='/upload/clip/catalog/';

  public function __construct(ClipRepository $clips)
  {
    $this->middleware('auth');
    $this->clips = $clips;

  }

  /**
   * User main page, profile page.
   *
   * @param  Request  $request
   * @param  User  $user
   * @return Response
   */
  public function userpage(Request $request, User $user)
  {
    $isAuth = Auth::user()->id == $user->id ? true : false;
    return view('user.page', [
      'user' => $user,
      'auth' => $isAuth,
      'url_clip_upload' => $this->url_clip_upload,
      'clips' => $this->clips->forUser($user)
    ]);
  }

  /**
   * main page.
   *
   * @param  Request  $request
   * @param  User  $user
   * @return Response
   */
  public function index(Request $request)
  {

    if (Auth::check()) {
      return view('clips.index', [
            'user' => $request->user(),
            'url_clip_upload' => $this->url_clip_upload,
            'clips' => $this->clips->forUser($request->user()),
      ]);
    } else {
      return view('home');
    }
    /*
    return view('user.page', [
      'user' => $request->user(),
      'clips' => $this->clips->forUser($user)
    ]);
    */
  }
}
