<?php

namespace Raoul\Validator\Exceptions;

class ValidationException extends \Exception
{
    protected $errors = [];
    protected $messages = [];
    public function __construct($errors, $messages)
    {
        parent::__construct('Validation failed');
        $this->errors = $errors;
        $this->messages = $messages;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
    public function getMessages(): array
    {
        return $this->messages;
    }
}