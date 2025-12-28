import {
    queryParams,
    type RouteDefinition,
    type RouteFormDefinition,
    type RouteQueryOptions,
} from './../../../wayfinder';
/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});

index.definition = {
    methods: ['get', 'head'],
    url: '/my-library/artist',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
const indexForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\Library\LibraryArtistController::index
 * @see app/Http/Controllers/Library/LibraryArtistController.php:15
 * @route '/my-library/artist'
 */
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'get',
});

index.form = indexForm;

const artist = {
    index: Object.assign(index, index),
};

export default artist;
