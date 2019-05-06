<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FirebaseUser;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class HomeController extends Controller
{
    protected $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/filternews.json');
        $firebase           = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://filternews.firebaseio.com')
            ->create();
        $database = $firebase->getDatabase();

        $this->userRepository = $database->getReference('user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     // return view('home');
    //     return FirebaseUser::all();
    // }

    public function index()
    {
        $users = $this->userRepository->getValue();

        return view('home', compact('users'));
    }
}
