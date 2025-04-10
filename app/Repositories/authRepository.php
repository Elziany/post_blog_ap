<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthRepository {
    public function createUser($data) {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }
    public function getUserByEmail($email) {
        return User::where('email', $email)->first();
    }
}