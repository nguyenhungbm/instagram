<?php
namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Permission::class;
    }

    public function getPermission()
    {
        return $this->model->select('p_content')->take(5)->get();
    }
}