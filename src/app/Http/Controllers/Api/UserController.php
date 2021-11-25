<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Traits\ApiResponser;

use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController extends Controller
{
    use ApiResponser;

    private $userRepository;
    private $userService;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository 
    ){
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(){
        try{
            $res = $this->userService->getAll();
            return $this->successResponse($res);

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id){
        try{
            $res = $this->userService->findById($id);
            return $this->successResponse($res);

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(Request $request){

        $data = $request->only([
            'name','email','password'
        ]);
        
        try{
            $res = $this->userService->save($data);
            return $this->successResponse($res);

        }catch(Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}
