<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ClipRepository;

use App\User;


class UserController extends Controller
{
  /**
   * The clip repository instance.
   *
   * @var ClipRepository
   */
  protected $clips;

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
    return view('user.page', [
      'user' => $user,
      'clips' => $this->clips->forUser($user)
    ]);
  }
}
