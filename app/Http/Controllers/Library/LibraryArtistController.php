<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\LibraryArtistIndexRequest;
use App\Http\Resources\Library\LibraryArtistResource;
use App\Models\LibraryArtist;
use Inertia\Inertia;

class LibraryArtistController extends Controller
{
    public function index(LibraryArtistIndexRequest $request)
    {

        return Inertia::render('library/artist/Index', [
            'artists' => function () use ($request) {
                return LibraryArtistResource::collection(
                    LibraryArtist::ofUser($request->user())
                        ->with('canonicalArtist')
                        ->when($request->input('search'), function ($query, $search) {
                            $query->where('name', 'like', "%{$search}%");
                        })
                        ->orderBy($request->getOrderBy(), $request->getOrderDirection())
                        ->paginate($request->getPerPage())
                );
            },

            'search' => $request->input('search'),
        ]);
    }
}
