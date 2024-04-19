<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user, Post $post)
    {
        // Kiểm tra xem user có quyền xem post hay không
        return $user->id === $post->user_id;
    }

    public function update(User $user, Post $post)
    {
        // Kiểm tra xem user có quyền cập nhật post hay không
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        // Kiểm tra xem user có quyền xóa post hay không
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
