<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository{

    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function getAll(){

        $users = $this->user->get()->map(function($user){
            return $this->format($user);
        });
        return $users;
    }

    public function findById($id){

        $user = $this->user->findOrFail($id);

        return $this->format($user);
    }

    public function save($data){

        $user = new $this->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->email_verified_at = $data['email_verified_at'];
        $user->password = $data['password'];
        $user->remember_token = $data['remember_token'];
        $user->save();

        return $this->format($user->fresh());
    }

    public function format($user){
        return [
            'user_id' =>$user->id,
            'name' =>$user->name,
            'email' =>$user->email,
            'email_verified_at' =>strtotime($user->email_verified_at),
            'created_at' =>date('Y-m-d H:i:s', strtotime($user->created_at)),
            'updated_at' =>date('Y-m-d H:i:s', strtotime($user->updated_at)),
        ];
    }

}