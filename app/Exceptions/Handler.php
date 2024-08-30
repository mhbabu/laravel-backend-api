<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Check if the exception is an instance of ModelNotFoundException
        if ($exception instanceof ModelNotFoundException) {
            // Return a JSON response with a 404 status code and a custom message
            return response()->json(['message' => 'Resource not found'], 404);
        }

        // Call the parent method for all other exceptions
        return parent::render($request, $exception);
    }
}
