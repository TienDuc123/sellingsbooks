<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRespository
{
    public function all()
    {
        return Comment::all();
    }

    public function find($id)
    {
        return Comment::find($id);
    }

    public function create($data)
    {
        return Comment::create($data);
    }

    public function update($id, $data)
    {
        $Comment = Comment::find($id);
        if ($Comment) {
            $Comment->update($data);
            return $Comment;
        }
        return null;
    }

    public function delete($id)
    {
        $Comment = Comment::find($id);
        if ($Comment) {
            $Comment->delete();
            return true;
        }
        return false;
    }
}
