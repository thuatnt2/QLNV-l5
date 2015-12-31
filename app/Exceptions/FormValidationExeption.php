<?php


class FormValidationException extends \Exception
{
    /**
     * @var MessageBag
     */
    protected $errors;

    /**
     * @param string     $message
     * @param MessageBag $errors
     * @param int        $code
     * @param Exception  $previous
     */
    public function __construct($message = "", MessageBag $errors, $code = 0, Exception $previous = null)
    {
        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}