<?php
namespace App\Repositories;

use App\Models\RoleUser;

class RoleUserRespository
{
    public function all()
    {
        return RoleUser::all();
    }

    public function find($id)
    {
        return RoleUser::find($id);
    }

    public function create($data)
    {
        return RoleUser::create($data);
    }

    public function update($id, $data)
    {
        $RoleUser = RoleUser::find($id);
        if ($RoleUser) {
            $RoleUser->update($data);
            return $RoleUser;
        }
        return null;
    }

    public function delete($id)
    {
        $RoleUser = RoleUser::find($id);
        if ($RoleUser) {
            $RoleUser->delete();
            return true;
        }
        return false;
    }
}
