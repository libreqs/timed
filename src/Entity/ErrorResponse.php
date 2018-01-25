<?php

namespace App\Entity;

use JMS\Serializer\Annotation as Serializer;

class ErrorResponse {
    /**
     * @Serializer\Type("integer")
     * @Serializer\Expose
     * @var integer
     */
    private $code;

    /**
     * @Serializer\Type("string")
     * @Serializer\Expose
     * @var string
     */
    private $message;

    public function __construct($errorCode) {
        if (!isset($errorCode['code']) || !isset($errorCode['message'])) {
            throw new \InvalidArgumentException('You have to use a concrete error response code from Code!');
        }
        $this->code = $errorCode['code'];
        $this->message = $errorCode['message'];
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}