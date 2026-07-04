<?php
require_once __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../Core/Database.php';
class AuthService
{
    private function repository(): UserRepository
    {
        $config = require __DIR__.'/../../config/database.php';
        $pdo = (new Database($config));
        return new UserRepository($pdo->getConnection());
    }

    public function attempt(string $email, string $password): ?array
    {
        $user = $this->repository()->findByEmail($email);

        if(!$user)
            return null;
        if($password != $user['password_hash'])
            return null;

        return $user;
    }
}

