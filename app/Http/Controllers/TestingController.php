<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TestingController extends Controller
{
    /**
     * Form for testing
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Quantity of users per once
        if (!intval($request->q)) {
            $request->q = 1;
        }
        return view('test.index', [
            'token' => self::getApiUser(),
            'q' => intval($request->q)
        ]);
    }

    /**
     * Form for searchin'
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view('test.search', ['token' => self::getApiUser()]);
    }

    /**
     * Get user with not empty token
     * @return mixed
     */
    private static function getApiUser()
    {
        return User::where('api_token', '!=', '')->first();
    }
}
