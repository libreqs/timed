<?php
namespace App\Error;

/**
 * Class of error codes. Codes below 1000 are reserved for HTTP status codes (e.g. 500 will be delivered for general
 * internal server errors coming from exceptions). This error codes and messages are used for clear error communication
 * with the client (if the kind of problem is known).
 */
class Code
{
    const OK = array(
        'code' => 1000,
        'message' => 'all right, dude!'
    );

    const USER_NOT_FOUND = array(
        'code' => 4015,
        'message' => 'User not found'
    );

    const USER_ALREADY_EXISTS = array(
        'code' => 4020,
        'message' => 'User already exists'
    );
}