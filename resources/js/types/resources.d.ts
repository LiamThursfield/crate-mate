export interface DjUserResource {
    id: number;
    created_at: string;
    dj_name: string;
    libraries?: LibraryResource[];
}

export interface LibraryResource {
    id: string;
    created_at: string;
    name: string;
    source: string;
    user_id: number;
    user?: DjUserResource;
}

export interface LibraryTrackResource {
    id: string;
    created: string;
    bpm: number | null;
    duration: number | null;
    key: string | null;
    title: string;
    canonical_artist_id: number | null;
    canonical_track?: CanonicalTrackResource;
    library_id: string;
    library?: LibraryResource;
    library_artist_id: string;
    library_artist?: LibraryArtistResource;
}

export interface LibraryArtistResource {
    id: string;
    created: string;
    name: string;
    canonical_artist_id: number | null;
    canonical_artist?: CanonicalArtistResource;
    library_id: string;
    library?: LibraryResource;
}

export interface CanonicalArtistResource {
    id: number;
    created_at: string;
    is_verified: boolean;
    name: string;
    verified_at: string | null;
    user_id: number | null;
    user?: DjUserResource;
}

export interface CanonicalTrackResource {
    id: number;
    created_at: string;
    bpm: number | null;
    duration: number | null;
    is_verified: boolean;
    key: string | null;
    title: string;
    verified_at: string | null;
    canonical_artist?: CanonicalArtistResource;
    canonical_artist_id: number;
    library_tracks_count?: number;
    library_tracks?: LibraryTrackResource[];
    user_id: number | null;
    user?: DjUserResource;
}
