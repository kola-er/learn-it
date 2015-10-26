<?php

namespace Learn\Http\Controllers;

use Illuminate\Http\Request;
use Learn\Http\Requests;
use Learn\Video;
use \Auth;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$haystacks = ['=', '/'];

		foreach ($haystacks as $haystack) {
			$videoID = substr($request['url'], strrpos($request['url'], $haystack, -1) + 1);

			if ($this->videoExist($videoID)) {
				Video::create([
					'user_id'  		=> Auth::user()->id,
					'category_id' 	=> $request['category'],
					'title' 		=> $request['title'],
					'description' 	=> $request['description'],
					'url' 			=> $videoID
				]);

				return redirect('dashboard');
			}
		}

		return 'Invalid Youtube video link! Go back to <a href="dashboard">dashboard</a>';
    }

    protected function videoExist($videoID)
    {
        $theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoID&format=json";
        $headers = get_headers($theURL);

        return (substr($headers[0], 9, 3) !== "404") ? true : false;
    }
}
