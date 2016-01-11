<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ClipRepository;

use App\Clip;

class ClipController extends Controller
{

    /**
     * The clip repository instance.
     *
     * @var ClipRepository
     */
    protected $clips;

    public $path_clip_upload ='/public/upload/clip/catalog/';
    public $url_clip_upload ='/upload/clip/catalog/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClipRepository $clips)
    {
        $this->middleware('auth');
        $this->clips = $clips;
    }

    /**
     * Display a list of all of the user's clip.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('clips.index', [
            'url_clip_upload' => $this->url_clip_upload,
            'clips' => $this->clips->forUser($request->user()),
        ]);
    }

  /**
   * Create a new clip.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $this->validate($request, [
          'caption' => 'required|max:255',
          //'audio'       => 'required|mimes:audio/mpeg'
      ]);
      $clip = $request->user()->clips()->create([
        'caption' => $request->caption,
        'url_clip' => "test",
      ]);
      $clipName = $clip->id . '.' .$request->file('audio')->getClientOriginalExtension();
      $request->file('audio')->move(
        base_path() . $this->path_clip_upload, $clipName
      );
      $clip->url_clip = $clipName;
      $clip->save();


      return redirect('/clips');
  }

  /**
   * Destroy the given clip.
   *
   * @param  Request  $request
   * @param  Clip  $clip
   * @return Response
   */
  public function destroy(Request $request, Clip $clip)
  {
      $this->authorize('destroy', $clip);
      $clip->delete();
      return redirect('/clips');
  }


}
