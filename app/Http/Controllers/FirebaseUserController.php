<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FirebaseUserController extends Controller
{
    protected $userRepository;
    protected $database;
    protected $firebase;

    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/filternews.json');
        $this->firebase           = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://filternews.firebaseio.com')
            ->create();
        $this->database = $this->firebase->getDatabase();

        $this->userRepository = $this->database->getReference('user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->orderByKey()->equalTo($id)->getValue();
        // $user = json_decode($user, true);

        // return $user[$id];
        $user = $user[$id];

        return view('show', compact('user', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            '' . $request->time => $request->value
        ];
        $update = [
            'user/' . $id . '/' . $request->type . '/' . $request->key => $data
        ];
        $this->database->getReference()->update($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $reference = 'user/' . $id . '/' . $request->type . '/' . $request->key;
        $this->database->getReference($reference)->remove();
    }

    public function deleteUser(Request $request, $id)
    {
        $reference = 'user/' . $id;
        $this->database->getReference($reference)->remove();
    }
}
