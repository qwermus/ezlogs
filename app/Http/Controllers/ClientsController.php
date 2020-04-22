<?php

namespace App\Http\Controllers;

use App\Client;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ClientsRequest;
use App\Http\Requests\ClientsSearchRequest;
use Illuminate\Support\Facades\Storage;

class ClientsController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(ClientsSearchRequest $request)
    {
        $clients = new Client;
        $clients = $clients->whereLike('firstname', $request->firstname)
            ->whereLike('surname', $request->surname)
            ->whereLike('license', $request->license)
            ->whereLike('photo', $request->photo)
            ->whereLike('phone_text', $request->phone_text)
            ->whereLike('phone_int', $request->phone_int)
            ->whereLike('address', $request->address);


        // Search by age
        if ($request->age_from != '') {
            $clients = $clients->where('age','>=', $request->age_from );
        }

        // Search by age
        if ($request->age_till != '') {
            $clients = $clients->where('age','<=', $request->age_till );
        }

        // Search by comment
        if ($request->comment != '') {
            $clients = $clients->whereHas('comments', function ($query) use($request) {
                $query->where('comment', 'like', '%'.$request->comment.'%');
            });
        }

        return $clients->get()->toArray();

    }

    /**
     * Store a user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsRequest $request)
    {
        // Convert request to array
        $data = $request->all();
        $files = $request->file('photo');

        for ( $i = 0; $i < $data['quantity']; $i ++ ) {

            // Working with one user

            // Store image
            $photo = self::uploadPhoto($files[$i]);

            // We can put upload higher, and if upload failed - show error. Now i think it's not necessary
            // return ['message' => __('api.imageerror')];

            // Save user info
            $user = Client::create([
                'firstname' => $data['firstname'][$i],
                'surname' => $data['surname'][$i],
                'age' => $data['age'][$i],
                'license' => $data['license'][$i],
                'photo' => $photo,
                'phone_text' => $data['phone_text'][$i],
                'phone_int' => $data['phone_int'][$i],
                'address' => $data['address'][$i]
            ]);

            // Iterate all comments
            foreach ($data['comment'][$i] as $key => $comment) {
                if ($comment != '') {
                    // Save each comment
                    $user->comments()->create([
                        'comment_id' => $key,
                        'comment' => $comment
                    ]);
                }
            }
        }
        // Return success
        return ['status' => 'success'];
    }

    /**
     * @param $image
     * @return bool
     */
    private static function uploadPhoto($image)
    {
        // Check if image was uploaded. It is required so this is unnecessary
        if ($image === null) {
            return false;
        }

        // Store image to photo folder
        $image = $image->store("photo", "public");

        // If image was stored successfully - return it
        if ($image)
        {
            return $image;
        }

        // Else return false
        return false;
    }

}
