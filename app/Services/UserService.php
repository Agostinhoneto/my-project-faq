<?php
namespace App\Services;
use App\Http\Repositories\UserRepository;

class UserService {
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($name, $email,$password)
    {
        $result = $this->userRepository->save($name, $email,$password);
        return $result;
    }
 
}
?>