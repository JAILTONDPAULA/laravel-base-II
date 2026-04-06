<?php namespace App\Services;

use App\Helpers\TokenHelper;
use App\Models\Token;
use App\Models\User;
use App\Validators\UserValidator;

class ResetPassword
{

    public User $user;
    public Token $token;

    public function __construct(string $email)
    {
        $this->user = (new UserValidator())->validate($email);
    }

    public function resetPassword(): void
    {
        $token = TokenHelper::generateNumericToken();
        $this->token = $this->user->tokens()->create([
            'token' => $token,
            'email' => $this->user->email,
        ]);
    }
}
