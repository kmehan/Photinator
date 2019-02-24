<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Photo;

class PhotosController extends Controller
{
    public function index() {
      //Returns the IDs of all photo likes in ascending order by timestamp
      $sortedPhotos = Photo::orderBy('created_at','ASC')->distinct('picture_id')->pluck('picture_id');
      return response($sortedPhotos->toJson(),Response::HTTP_OK);
    }
    public function update($idPair) {
      //Creates a new like for a photo based on user and picture ID
      list($picid,$userid) = $this->getIDs($idPair);
      $photo = new Photo();
      $photo->picture_id = $picid;
      $photo->user_id = $userid;
      $photo->save();
      return response($photo->toJson(), Response::HTTP_CREATED);
    }
    public function show($idPair)  {
      //Returns the current like status for a picture as 'found' or 'notfound' based on user and picture ID
      list($picid,$userid) = $this->getIDs($idPair);
      $photo = Photo::where([['picture_id',$picid],['user_id',$userid]])->get();
      if ($photo->isEmpty()) {
        return response('notfound',Response::HTTP_OK);
      } else {
        return response('found',Response::HTTP_OK);
      }
    }
    public function destroy($idPair) {
      //Removes the like for a given photo based on user and picture ID
      list($picid,$userid) = $this->getIDs($idPair);
      $photo = Photo::where([['picture_id',$picid],['user_id',$userid]])->delete();
      return response(null,Response::HTTP_OK);
    }
    public function ranking() {
      //Returns ranking of registered users with their name and number of likes
      $photos = Photo::select('user_id')->selectRaw('count(user_id) as likes')->groupBy('user_id')->orderBy('likes','DESC')->get();
      $ranking = [];
      foreach ($photos as $p) {
        $ranking[] = ['name' => $p->user->name,'likes' => $p->likes];
      }
    }
    private function getIDs($idPair) {
      //Sanitizes and processes JSON argument passed to API and returns as key-value pair of user and picture ID for functions
      $json = rtrim(ltrim($idPair,'"'),'"');
      $decodedId = json_decode($json,true);
      $picid = $decodedId["pid"];
      $userid = $decodedId["uid"];
      return array($picid,$userid);
    }
}
