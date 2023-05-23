<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(string $username) {
        $currentUser = Account::where('username', $username)->get();
        $currentUser = $currentUser[0];
        return $currentUser['password'];
    }
}
