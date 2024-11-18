<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertCaseMiddleware
{
    /**
     * Convert all keys in the request from camelCase to snake_case.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Convert request data from camelCase to snake_case
        $this->convertRequestData($request);

        // Proceed with the request
        $response = $next($request);

        // Convert response data from snake_case to camelCase
        $this->convertResponseData($response);

        return $response;
    }

    /**
     * Convert all request data from camelCase to snake_case.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function convertRequestData(Request $request)
    {
        $request->replace($this->camelToSnake($request->all()));
    }

    /**
     * Convert all response data from snake_case to camelCase.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    protected function convertResponseData(Response $response)
    {
        // Only modify JSON responses
        if ($response->headers->get('Content-Type') === 'application/json') {
            $data = json_decode($response->getContent(), true);
            if (is_array($data)) {
                $response->setContent(json_encode($this->snakeToCamel($data)));
            }
        }
    }

    /**
     * Convert an array of keys from camelCase to snake_case.
     *
     * @param  array  $data
     * @return array
     */
    protected function camelToSnake(array $data)
    {
        return collect($data)->mapWithKeys(function ($value, $key) {
            return [Str::snake($key) => $value];
        })->toArray();
    }

    /**
     * Convert an array of keys from snake_case to camelCase.
     *
     * @param  array  $data
     * @return array
     */
    protected function snakeToCamel(array $data)
    {
        return collect($data)->mapWithKeys(function ($value, $key) {
            return [Str::camel($key) => $value];
        })->toArray();
    }
}
