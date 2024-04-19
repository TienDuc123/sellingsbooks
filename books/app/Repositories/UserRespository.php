<?php
namespace App\Repositories;

use App\Models\User;

class UserRespository
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create($data)
    {
        $user = User::create($data);
        return $user->id;
    }

    public function update($id, $data)
    {
        $User = User::find($id);
        if ($User) {
            $User->update($data);
            return $User;
        }
        return null;
    }

    public function delete($id)
    {
        $User = User::find($id);
        if ($User) {
            $User->delete();
            return true;
        }
        return false;
    }
}
