<?php

namespace App\Api\V1\Controllers;

use Illuminate\Foundation\Testing\HttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends Controller implements ApiControllerInterface
{

    use Helpers;

    public function index(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser->books()
                            ->orderBy('created_at', 'DESC')
                            ->get()
                            ->toArray();
    }

    public function dataTable()
    {
        // TODO: Implement dataTable() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function show($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = $currentUser->books()->find($id);
        if (!$book)
            throw new NotFoundHttpException('User not found');
        return $book;

    }

    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = New Book();

        $book->title = $request->get('title');
        $book->author_name = $request->get('author_name');
        $book->pages_count = $request->get('pages_count');

        if ($currentUser->books()->save($book))
            return $this->response->created();
        else
            return $this->response->error('could_not_created_book', 500);
    }

    public function update(Request $request, $id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = $currentUser->books()->find($id);
        if (!$book)
            throw new NotFoundHttpException();
        $book->fill($request->all());
        if ($book->save())
            return $this->response->noContent();
        else
            return $this->response->error('could not update book', 500);
    }

    public function destroy($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $book = $currentUser->books()->find($id);
        if (!$book)
            throw new NotFoundHttpException();
        if ($book->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could not delete book', 500);
    }
}
