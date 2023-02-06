<?php
namespace App\Services;
use App\Http\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class UserService {
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll(){
        return $this->userRepository
        ->getAllUser();
    }
    public function getById($id){
        return $this->userRepository
        ->getById($id);
    }
    public function register($name, $email,$password)
    {
        $result = $this->userRepository
        ->save($name, $email,$password);
        return $result;
    }

    public function update($id,$name, $email,$password)
    {
        $result = $this->userRepository
        ->update($id,$name,$email,$password);
        return $result;
    }

    public function deleteById($id){
        DB::beginTransaction();
        try{
            DB::commit();
            $user = $this->userRepository->delete($id);
        }
        catch(Exception $e){
            DB::roolBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não pode ser deletado');
        }
        return $user;
    }
 
}
?>