<?php
namespace App\Repositories\Permission;

use App\Repositories\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getPermission();
} 