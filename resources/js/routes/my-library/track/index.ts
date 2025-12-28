import {
    queryParams,
    type RouteDefinition,
    type RouteFormDefinition,
    type RouteQueryOptions,
} from './../../../wayfinder';
/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});

index.definition = {
    methods: ['get', 'head'],
    url: '/my-library/track',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
 */
const indexForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
 */
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\Library\LibraryTrackController::index
 * @see app/Http/Controllers/Library/LibraryTrackController.php:15
 * @route '/my-library/track'
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

const track = {
    index: Object.assign(index, index),
};

export default track;
