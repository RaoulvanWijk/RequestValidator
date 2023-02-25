<?php

namespace Raoul\Validator\Rules;

class Email
{
  protected $field;
  protected $value;
  protected $params;
  protected $data;
  public function __construct($field, $value, $params, $data)
  {
    $this->field = $field;
    $this->value = $value;
    $this->params = $params;
    $this->data = $data;
  }

  public function validate(): bool
  {
    return filter_var($this->value, FILTER_VALIDATE_EMAIL);
  }

  public function getMessage(): string
  {
    return "The {$this->field} field must be a valid email";
  }
}