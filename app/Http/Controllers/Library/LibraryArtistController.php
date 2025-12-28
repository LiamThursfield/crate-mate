<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginatedRequest;
use App\Http\Resources\Library\LibraryArtistResource;
use App\Models\LibraryArtist;
use Inertia\Inertia;

class LibraryArtistController extends Controller
{
    public function index(PaginatedRequest $request)
    {
        return Inertia::render('library/artist/Index', [
            'artists' => function () use ($request) {
                return LibraryArtistResource::collection(
                    LibraryArtist::ofUser($request->user())
                        ->with('canonicalArtist')
                        ->orderBy($request->getOrderBy(), $request->getOrderDirection())
                        ->paginate($request->getPerPage())
                );
            },
        ]);
    }
}
