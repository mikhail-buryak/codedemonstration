<?php

namespace App\Http\Controllers;

use DB;
use App\Book;
use Datatables;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAll()
    {
        $posts = Book::leftJoin('autors', 'books.autor_id', '=', 'autors.id')
            ->select(['books.id', 'books.title', 'books.preview', 'books.write_at', 'books.created_at', 'autors.name']);

        return Datatables::of($posts)
            ->editColumn('id', 'ID: {{$id}}')
            ->editColumn('title', '{{ str_limit($title, 60) }}')
            ->editColumn('preview', '@if($preview) <img class="cover" src="/images/covers/{{ $preview }}">@endif')
            ->editColumn('created_at', '{!! $created_at->diffForHumans() !!}')
            ->addColumn('action', function ($posts) {
                return '<button type="button" data-action="/workflow/items/view/'.$posts->id.'" class="btn btn-xs btn-info btn-modal">View</button>
                <button type="button" data-action="/workflow/items/edit/'.$posts->id.'" class="btn btn-xs btn-warning btn-modal">Edit</button>
                <button type="button" data-action="/workflow/items/delete/'.$posts->id.'" class="btn btn-xs btn-danger book-delete">Delete</button>';
            })
            ->make(true);
    }

    public function getView($id, Request $request)
    {
        if (!$request->ajax()) return response()->json([ 'status' => 'error' ], 400);

        $book = Book::find($id);
        return view('modal.view')->with('book', $book);
    }

    public function getEdit($id, Request $request)
    {
        if (!$request->ajax()) return response()->json([ 'status' => 'error' ], 400);

        $book = Book::find($id);
        return view('modal.edit')->with('book', $book);
    }

    public function postStore($id, Request $request)
    {
        // Check request params
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'write_at' => ['required', 'string', 'max:24'],
            'preview' => ['mimes:jpg,jpeg,png,gif', 'image', 'max:5000'],
            'img_changed' => ['numeric']
        ]);

        if ($validator->fails())
            return response()->json(['status' => 'error', 'statusCode' => 400, 'data' => $validator->errors()], 400);

        $book = Book::find($id);

        if($request->input('img_changed') == 1)
        {
            $book->deleteCover();

            $fileName = str_random(16);
            $request->file('preview')->move(storage_path('images/covers/'), $fileName);
            $book->preview = $fileName;
        }

        $book->title = $request->input('title');
        $book->write_at = $request->input('write_at');
        $book->save();

        return response()->json([ 'status' => 'success' ]);
    }

    public function postDelete($id)
    {
        $book = Book::find($id);

        if($book == null) return response()->json([ 'status' => 'error' ], 400);

        $book->deleteCover();

        $book->delete();

        return response()->json([ 'status' => 'success' ]);
    }
}
