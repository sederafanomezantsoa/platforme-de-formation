<?php
require_once __DIR__. "/../model/user.php";

class UserController
{
    private User $userModel;

    public function __construct(PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function addUser(string $name,string $email,string $password,string $password_v)
    {
        $this->userModel->addUser($name,$email,$password,$password_v);
    }  
    public function deleteUser(string $id)
    {
        return $this->userModel->deleteUser($id);
    }  
    public function findUser(string $students)
   {
	return $this->userModel->findUser($students);
   }
   public function getDetailsUser(int $id)
   {
        return $this->userModel->getDetailsUser($id);
   }

   public function login(string $email,string $password): ?array
   {
   	return $this->userModel->login($email,$password);
   }
}

