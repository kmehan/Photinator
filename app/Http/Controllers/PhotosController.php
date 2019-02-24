<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Photo;

class PhotosController extends Controller
{
    public function index() {
      //Returns the IDs of all photo likes in descending order by timestamp
    }
    public function update()  {
      //Creates a new like for a photo based on user and picture ID
    }
    public function show()  {
      //Returns the current like status for a picture as 'found' or 'notfound' based on user and picture ID
    }
    public function destroy() {
      //Removes the like for a given photo based on user and picture ID
    }
    public function ranking() {
      //Returns ranking of registered users with their name and number of likes
    }
    private function getIds() {
      //Sanitizes and processes JSON argument passed to API and returns as key-value pair of user and picture ID for functions
    }
}
