# Laravel Full Site Search

---

Perform full site search based on Laravel Scout. Bringing the search everything box to live in a laravel app.

## Quick Start

```php
// Expect a collection of models in the search result
$results = App\Classes\SideWideSearch\SiteWideSearch::search('in');
```

Each model returned has 3 additional attributes:

1. `match` -- the match + neighbouring text found from our DB records
2. `model` -- the related model name
3. `view_link` -- the URL for the user to navigate in the frontend to view the resource

To return the results as an API response:
```php
// Controller
return App\Classes\SideWideSearch\Resources\SiteWideSearchResource::collection($results);
```

For your convenience, we have bootstrapped the API endpoint for you. You can disable this in the config file.
Just set the `fullsite-search.api.disabled` config to `true`.

### Example:

URL: `/api/site-search?search=in`

We get:

```json
{
    "data": [
        {
            "id": 2,
            "match": "...ER happen in a frighte...",
            "model": "Post",
            "view_link": "http://127.0.0.1:8000/posts/2"
        },
        {
            "id": 4,
            "match": "Drawling, Stretching, ...",
            "model": "Post",
            "view_link": "http://127.0.0.1:8000/posts/4"
        },
        {
            "id": 6,
            "match": "...ed to her in the dista...",
            "model": "Post",
            "view_link": "http://127.0.0.1:8000/posts/6"
        }
    ]
}
```

This is the contents of the published config file:

```php
return [

    // path to your models directory, relative to /app
    'model_path' => 'Models',

    'api' => [
        // enable api endpoint
        'disabled' => false,
        // the api endpoint uri
        'url' => '/api/site-search',
    ],

    // the result limit per model when conducting the search
    'search_limit_per_model' => 5,

    // you can put any models that you want to exclude from the search here
    'exclude' => [
        // example:
        // \App\Models\Comment::class
    ],

    // the number of neighbouring characters that you want to include in the match field of API response
    'buffer' => 15,

    // this is where you define where should the search result leads to.
    // the link should navigate to the resource view page
    // by default, we use `/<model-name>/<model-id>` , you can define anything here
    // We will replace `{id}` or `{ id }` with the model id
    'view_mapping' => [
        // \App\Models\Comment::class => '/comments/view/{id}'
    ],
];
```
