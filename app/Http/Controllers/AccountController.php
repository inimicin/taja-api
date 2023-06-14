<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    // public function show(string $username) {
    //     $accounts = Account::where('username', $username)->get();
        
    //     if($accounts->count() > 0) {
    //         $currentUser = $accounts[0];
    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Success',
    //             'data' => [
    //                 'currentUser' => $currentUser,
    //             ],
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => 404,
    //         'message' => 'Account Not Found',
    //         'data' => [],
    //     ]);
    // }

    public function show_by_id(int $id) {
        $accounts = Account::find($id);
        
        if($accounts) {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => [
                    'currentUser' => $accounts,
                ],
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Account Not Found',
            'data' => [],
        ]);
    }

    public function auth(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $accounts = Account::where('username', $username)->get();

        if ($accounts->count() > 0) {
            $currentAccount = $accounts[0];
            if ($password === Crypt::decryptString($currentAccount['password'])) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Success',
                    'data' => [],
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'Password Mismatch',
                'data' => [],
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Account Not Found',
            'data' => [],
        ]);
    }

    public function save(Request $request) {
        if(Account::where('username', $request->input('username'))->get()->count() > 0) {
            return response()->json([
                'status' => 400,
                'message' => 'Username Already Exists',
                'data' => [],
            ]);
        }

        $newAccount = new Account;
        $newAccount->username = $request->input('username');
        $newAccount->password = Crypt::encryptString($request->input('password'));
        $newAccount->role = 'Farmer';
        $newAccount->save();

        $currentUser = Account::where('username', $request->input('username'))->get();

        if($currentUser->count() === 0) {
            return response()->json([
                'status' => 400,
                'message' => 'Register Failed',
                'data' => [],
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Register Success',
                'data' => [],
            ]);;
        }
    }

    public function update(Request $request) {
        $username = $request->input('username');
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $accounts = Account::where('username', $username)->get();

        if ($accounts->count() > 0) {
            $currentAccount = $accounts[0];
            if ($oldPassword === Crypt::decryptString($currentAccount['password'])) {
                $currentAccount->update(['password' => Crypt::encryptString($newPassword)]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Success',
                    'data' => [],
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'Password Mismatch',
                'data' => [],
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Account Not Found',
            'data' => [],
        ]);
    }

    public function delete(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $accounts = Account::where('username', $username)->get();

        if ($accounts->count() > 0) {
            $currentAccount = $accounts[0];
            if ($password === Crypt::decryptString($currentAccount['password'])) {
                $currentAccount->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Success',
                    'data' => [],
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'Password Mismatch',
                'data' => [],
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'Account Not Found',
            'data' => [],
        ]);
    }
}
