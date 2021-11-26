<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findByEmail($email);
    public function save($data);
}
