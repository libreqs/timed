<?php
namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IllegalStateException extends HttpException {
    /**
     * Constructor.
     *
     * @param string $message The internal exception message
     * @param \Exception $previous The previous exception
     * @param int $code The internal exception code
     */
    public function __construct($message = 'Internal server error.', \Exception $previous = null, $headers = array(), $code = 0)
    {
        parent::__construct(Response::HTTP_INTERNAL_SERVER_ERROR, $message, $previous, $headers, $code);
    }
}