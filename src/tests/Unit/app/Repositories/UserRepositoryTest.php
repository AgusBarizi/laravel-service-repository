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
    use WithFaker;

    protected $userRepository;
    
    public function setUp():void
    {
        parent::setUp();
        $this->userRepository = new UserRepository(new User());
    }


    public function testSave()
    {
        $this->withoutExceptionHandling();
        $plain_password = 'password';
        $params = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make($plain_password),
            'email_verified_at' => now(),
            'remember_token' => \Str::random(10),
        ];
        $result = $this->userRepository->save($params);
            
        $this->assertEquals($params['name'], $result->name);
        $this->assertEquals($params['email'], $result->email);
        $this->assertEquals($params['password'], $result->password);
    }

    public function testGetAll()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $result = $this->userRepository->getAll();
        // print_r($result);
        $this->assertIsArray($result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $result = $this->userRepository->findById($user->id);

        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($user->email, $result->email);
    }

    public function testFindByEmail()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $result = $this->userRepository->findByEmail($user->email);

        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($user->email, $result->email);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $params = [
            'name'=>'John Smith'
        ];
        $result = $this->userRepository->update($user->id, $params);
        // print_r($result);
        $this->assertEquals($user->id, $result->user_id);
        $this->assertEquals($params['name'], $result->name);
    }

    public function testDelete()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $result = $this->userRepository->delete($user->id);
        // \dd($result);
        $this->assertTrue($result);
    }
}
