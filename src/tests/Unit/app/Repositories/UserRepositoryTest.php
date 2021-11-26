<?php

namespace Tests\Unit\app\Repositories;

// use PHPUnit\Framework\TestCase;

use App\Models\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepositoryTest extends TestCase
{
    /**
     * vendor/bin/phpunit --filter UserRepositoryTest
     * 
     * @return void
     */


    // public function testGetAll()
    // {
    //     $userRepository = new UserRepository(new User());
    //     // try{
    //         $result = $userRepository->findById(1);
    //     // }catch(\Exception $e){

    //     // }
            
    //     $this->assertJson($result);
    // }

    public function testSave()
    {
        $this->withoutExceptionHandling();
        $plain_password = 'password';
        $params = [
            'name' => 'Agus',
            'email' => random_int(0,100).'agusbarizi@gmail.com',
            'password' => Hash::make($plain_password),
            'email_verified_at' => now(),
            'remember_token' => 1,
        ];
        $userRepository = new UserRepository(new User());
        $result = $userRepository->save($params);
            
        $this->assertEquals($params['name'], $result['name']);
        $this->assertEquals($params['email'], $result['email']);
        $this->assertEquals($params['password'], $result['password']);
    }
}
