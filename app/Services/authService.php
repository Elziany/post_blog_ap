<?php
namespace App\Services;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService {
    protected AuthRepository $authRepository;
    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
    }
    public function register($data) {
        $data['password'] = Hash::make($data['password']);
        $user =  $this->authRepository->createUser($data);
         $token = $user->createToken('auth-token')->plainTextToken;
         return [
        'token' => $token,
        'user'  => $user];

    }
    public function login($credentials) {
        $user = $this->authRepository->getUserByEmail($credentials['email']);

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw new ValidationException('Invalid credentials');
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return [
            'token' => $token,
            'user'  => $user
        ];
    }
    public function logout() {
        Auth::logout();
    }
}