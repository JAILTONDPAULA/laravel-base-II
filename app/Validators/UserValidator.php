<?php namespace App\Validators;

class UserValidator
{
    public function validate(string $email)
    {
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            throw new \Exception('Usuário não encontrado');
        }

        if($user->excluido) {
            throw new \Exception('Usuário inativo');
        }

        return $user;
    }
}
