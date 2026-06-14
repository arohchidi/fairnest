<?php

namespace App\Contracts\Services;

use Illuminate\Pagination\LengthAwarePaginator;


interface UserServiceInterface
{
   public function getUsersStatistics():array;
   public function getFilteredUsers(array $filters): LengthAwarePaginator;
   public function getUserById(int $id);
   public function deleteUser(int $id);
   public function toggleUserStatus(int $id):bool;
   public function editUser(int $id);
   public function updateUser(int $id, array $data):array;
   public function createUser(array $data);

}




?>