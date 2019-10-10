<?php

return [

    /*
     * The output path for the generated documentation.
     * This path should be relative to the root of your application.
     */
    'output' => 'public/docs',

    /*
     * The router to be used (Laravel or Dingo).
     */
    'router' => 'laravel',

    /*
     * The base URL to be used in examples and the Postman collection.
     * By default, this will be the value of config('app.url').
     */
    'base_url' => 'http://api-dev3.fiscalia.gob.bo',

    /*
     * Generate a Postman collection in addition to HTML docs.
     */
    'postman' => [
        /*
         * Specify whether the Postman collection should be generated.
         */
        'enabled' => true,

        /*
         * The name for the exported Postman collection. Default: config('app.name')." API"
         */
        'name' => null,

        /*
         * The description for the exported Postman collection.
         */
        'description' => null,
    ],

    /*
     * The routes for which documentation should be generated.
     * Each group contains rules defining which routes should be included ('match', 'include' and 'exclude' sections)
     * and rules which should be applied to them ('apply' section).
     */
    'routes' => [
        [
            /*
             * Specify conditions to determine what routes will be parsed in this group.
             * A route must fulfill ALL conditions to pass.
             */
            'match' => [

                /*
                 * Match only routes whose domains match this pattern (use * as a wildcard to match any characters).
                 */
                'domains' => [
                    '*',
                    // 'domain1.*',
                ],

                /*
                 * Match only routes whose paths match this pattern (use * as a wildcard to match any characters).
                 */
                'prefixes' => [
                    '*',
                    // 'users/*',
                ],

                /*
                 * Match only routes registered under this version. This option is ignored for Laravel router.
                 * Note that wildcards are not supported.
                 */
                'versions' => [
                    'v2'
                ],
            ],

            /*
             * Include these routes when generating documentation,
             * even if they did not match the rules above.
             * Note that the route must be referenced by name here (wildcards are supported).
             */
            'include' => [
                // 'users.index', 'healthcheck*'
            ],

            /*
             * Exclude these routes when generating documentation,
             * even if they matched the rules above.
             * Note that the route must be referenced by name here (wildcards are supported).
             */
            'exclude' => [
                // 'users.create', 'admin.*'
            ],

            /*
             * Specify rules to be applied to all the routes in this group when generating documentation
             */
            'apply' => [
                /*
                 * Specify headers to be added to the example requests
                 */
                'headers' => [
                    'Authorization' => 'Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}',
                    //'Api-Version' => 'v2',
                ],

                /*
                 * If no @response or @transformer declarations are found for the route,
                 * we'll try to get a sample response by attempting an API call.
                 * Configure the settings for the API call here.
                 */
                'response_calls' => [
                    /*
                     * API calls will be made only for routes in this group matching these HTTP methods (GET, POST, etc).
                     * List the methods here or use '*' to mean all methods. Leave empty to disable API calls.
                     */
                    'methods' => ['GET', 'POST', 'PUT', 'PATCH'],

                    /*
                     * For URLs which have parameters (/users/{user}, /orders/{id?}),
                     * specify what values the parameters should be replaced with.
                     * Note that you must specify the full parameter,
                     * including curly brackets and question marks if any.
                     *
                     * You may also specify the preceding path, to allow for variations,
                     * for instance 'users/{id}' => 1 and 'apps/{id}' => 'htTviP'.
                     * However, there must only be one parameter per path.
                     */
                    'bindings' => [
                        'v2/casos/{hecho}/sujetosProcesales?tipo=1' => '324727',
                        'v2/casos/{hecho}' => '324727',
                        'v2/casos/{hecho}/medidas?ci=001' => '35101020100600',

                    ],

                    /*
                     * Laravel config variables which should be set for the API call.
                     * This is a good place to ensure that notifications, emails
                     * and other external services are not triggered
                     * during the documentation API calls
                     */
                    'config' => [
                        'app.env' => 'documentation',
                        'app.debug' => false,
                        // 'service.key' => 'value',
                    ],

                    /*
                     * Headers which should be sent with the API call.
                     */
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}',
                    ],

                    /*
                     * Cookies which should be sent with the API call.
                     */
                    'cookies' => [
                        // 'name' => 'value'
                    ],

                    /*
                     * Query parameters which should be sent with the API call.
                     */
                    'query' => [
                        // 'key' => 'value',
                    ],

                    /*
                     * Body parameters which should be sent with the API call.
                     */
                    'body' => [
                        // 'key' => 'value',
                    ],
                ],
            ],
        ],
    ],

    /*
     * Custom logo path. The logo will be copied from this location
     * during the generate process. Set this to false to use the default logo.
     *
     * Change to an absolute path to use your custom logo. For example:
     * 'logo' => resource_path('views') . '/api/logo.png'
     *
     * If you want to use this, please be aware of the following rules:
     * - the image size must be 230 x 52
     */
    'logo' => 'public/images/logo.png',

    /*
     * Name for the group of routes which do not have a @group set.
     */
    'default_group' => 'general',

    /*
     * Example requests for each endpoint will be shown in each of these languages.
     * Supported options are: bash, javascript, php, python
     * You can add a language of your own, but you must publish the package's views
     * and define a corresponding view for it in the partials/example-requests directory.
     * See https://laravel-apidoc-generator.readthedocs.io/en/latest/generating-documentation.html
     *
     */
    'example_languages' => [
        'bash',
        'javascript',
    ],

    /*
     * Configure how responses are transformed using @transformer and @transformerCollection
     * Requires league/fractal package: composer require league/fractal
     *
     */
    'fractal' => [
        /* If you are using a custom serializer with league/fractal,
         * you can specify it here.
         *
         * Serializers included with league/fractal:
         * - \League\Fractal\Serializer\ArraySerializer::class
         * - \League\Fractal\Serializer\DataArraySerializer::class
         * - \League\Fractal\Serializer\JsonApiSerializer::class
         *
         * Leave as null to use no serializer or return a simple JSON.
         */
        'serializer' => null,
    ],

    /*
     * If you would like the package to generate the same example values for parameters on each run,
     * set this to any number (eg. 1234)
     *
     */
    'faker_seed' => null,
];
