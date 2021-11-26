<?php

namespace App\Services;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use InvalidArgumentException;

class UserService{

    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getAll(){
        return $this->userRepository->getAll();
    }

    public function findById($id){
        return $this->userRepository->findById($id);
    }

    public function save($data){

        $validator = Validator::make($data, [
            'name'=>'required',
            'email'=>[
                'required',
                // 'unique:users,email'
                function ($attribute, $value, $fail) use($data) {
                    try{
                        $this->userRepository->findByEmail($data['email']);
                        $fail('The '.$attribute.' has already been taken.');
                    }catch(Exception $e){}
                },
            ],
            'password'=>'required'
        ]);

        if($validator->fails()){
            throw new ValidationException($validator->errors());
        }

        $data['password'] = Hash::make(trim($data['password']));
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(10);

        return $this->userRepository->save($data);
    }

}