<?php

namespace Tests\Unit\app\Repositories;

// use PHPUnit\Framework\TestCase;

use App\Models\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;

class UserRepositoryTest extends TestCase
{
    /**
     * vendor/bin/phpunit --filter UserRepositoryTest --verbose -c phpunit.xml
     * vendor/bin/phpunit --filter UserRepositoryTest::testGetAll --verbose -c phpunit.xml
     * php artisan test --filter UserRepositoryTest::testGetAll --verbose -c phpunit.xml
     * 
     * @return void
     */

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
            
        $this->assertEquals($params['name'], $result->name);
        $this->assertEquals($params['email'], $result->email);
        $this->assertEquals($params['password'], $result->password);
    }

    public function testGetAll()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $userRepository = new UserRepository(new User());
        $result = $userRepository->getAll();
        // print_r($result);
        $this->assertIsArray($result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $userRepository = new UserRepository(new User());
        $result = $userRepository->findById($user->id);

        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($user->email, $result->email);
    }

    public function testFindByEmail()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $userRepository = new UserRepository(new User());
        $result = $userRepository->findByEmail($user->email);

        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($user->email, $result->email);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $userRepository = new UserRepository(new User());
        $params = [
            'name'=>'John Smith'
        ];
        $result = $userRepository->update($user->id, $params);
        // print_r($result);
        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($params['name'], $result->name);
    }

    public function testDelete()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $userRepository = new UserRepository(new User());
        $result = $userRepository->delete($user->id);
        // \dd($result);
        $this->assertTrue($result);
    }
}
