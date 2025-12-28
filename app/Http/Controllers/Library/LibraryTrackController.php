<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\LibraryTrackIndexRequest;
use App\Http\Resources\Library\LibraryResource;
use App\Http\Resources\Library\LibraryTrackResource;
use App\Models\LibraryTrack;
use Inertia\Inertia;
use Inertia\Response;

class LibraryTrackController extends Controller
{
    public function index(LibraryTrackIndexRequest $request): Response
    {
        return Inertia::render('library/track/Index', [
            'tracks' => function () use ($request) {
                $search = $request->input('search');
                $libraryId = $request->input('library');

                return LibraryTrackResource::collection(
                    LibraryTrack::ofUser($request->user())
                        ->with(['canonicalTrack', 'library', 'libraryArtist'])
                        ->when($search !== null, function ($query) use ($search) {
                            $query->where('title', 'like', "%{$search}%");
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
