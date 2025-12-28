<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\LibraryArtistIndexRequest;
use App\Http\Resources\Library\LibraryArtistResource;
use App\Http\Resources\Library\LibraryResource;
use App\Models\LibraryArtist;
use Inertia\Inertia;
use Inertia\Response;

class LibraryArtistController extends Controller
{
    public function index(LibraryArtistIndexRequest $request): Response
    {
        return Inertia::render('library/artist/Index', [
            'artists' => function () use ($request) {
                $search = $request->input('search');
                $libraryId = $request->input('library');

                return LibraryArtistResource::collection(
                    LibraryArtist::ofUser($request->user())
                        ->with(['canonicalArtist', 'library'])
                        ->when($search !== null, function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        })
                        ->when($libraryId !== null, function ($query) use ($libraryId) {
                            $query->where('library_id', $libraryId);
                        })
                        ->orderBy($request->getOrderBy(), $request->getOrderDirection())
                        ->paginate($request->getPerPage())
                );
            },
            'libraries' => function () use ($request) {
                LibraryResource::withoutWrapping();

                return LibraryResource::collection(
                    $request->user()->libraries()
                        ->orderBy('source')
                        ->orderBy('name')
                        ->get()
                );
            },
            'search' => $request->input('search'),
            'library' => $request->input('library'),
        ]);
    }
}
