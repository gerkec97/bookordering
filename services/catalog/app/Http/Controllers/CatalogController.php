<?php

namespace App\Http\Controllers;

use GkCatalog\Domain\Domain\Services\CatalogServiceInterface;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function listBooks(Request $request)
    {
        try {
            $books = app(CatalogServiceInterface::class)->getBooks();
            return response()->json($books);
        } catch (\Exception $ex) {
            // LOG $ex->getMessage()
            return response()->json(['errors' => ['Error while processing request']], 500);
        }
    }
}
