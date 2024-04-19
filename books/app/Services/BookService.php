<?php
namespace App\Services;
use App\Repositories\BookRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OderRepository;
use App\Repositories\CommentRespository;
use App\Repositories\UserRespository;
use App\Repositories\RoleUserRespository;
class BookService
{
    protected $BookRepository;
    protected $CustomerRepository;
    protected $OderRepository;
    protected $CommentRespository;
    protected $UserRespository;
    protected $RoleUserRespository;

    public function __construct(BookRepository $BookRepository, CustomerRepository $CustomerRepository, OderRepository $OderRepository, CommentRespository $CommentRespository, UserRespository $UserRespository, RoleUserRespository $RoleUserRespository)
    {
        $this->BookRepository = $BookRepository;
        $this->CustomerRepository = $CustomerRepository;
        $this->OderRepository = $OderRepository;
        $this->CommentRespository = $CommentRespository;
        $this->UserRespository = $UserRespository;
        $this->RoleUserRespository = $RoleUserRespository;
    }

    public function getAllBook()
    {
        return $this->BookRepository->all();
    }

    public function getBookById($id)
    {
        return $this->BookRepository->find($id);
    }

    public function createBook($data)
    {
        return $this->BookRepository->create($data);
    }

    public function updateBook($id, $data)
    {
        return $this->BookRepository->update($id, $data);
    }

    public function deleteBook($id)
    {
        return $this->BookRepository->delete($id);
    }

    public function getAllCustomer()
    {
        return $this->CustomerRepository->all();
    }

    public function createCustomer($data)
    {
        return $this->CustomerRepository->create($data);
    }

    public function createOder($data)
    {
        return $this->OderRepository->create($data);
    }

    public function getAllComment()
    {
        return $this->CommentRespository->all();
    }

    public function createComment($data)
    {
        return $this->CommentRespository->create($data);
    }
    public function deletComment($id)
    {
        return $this->CommentRespository->delete($id);
    }

    public function getAllUser()
    {
        return $this->UserRespository->all();
    }
    public function getUserById($id)
    {
        return $this->UserRespository->find($id);
    }
    public function createUser($data)
    {
        return $this->UserRespository->create($data);
    }

    public function createRoleUser($data)
    {
        return $this->RoleUserRespository->create($data);
    }


}
