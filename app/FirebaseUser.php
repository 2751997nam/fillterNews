<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class FirebaseUser extends Model
{
    use SyncsWithFirebase;

    protected $table = 'user';

    protected $fillable = [
        'email', 'password', 'keyword', 'name', 'title', 'totaltime', 'username'
    ];
}
