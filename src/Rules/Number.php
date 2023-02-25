<?php

namespace Raoul\Validator\Rules;

class Number implements \Raoul\Validator\Contracts\RuleInterface
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
    return is_numeric($this->value);
  }

  public function getMessage(): string
  {
    return "The {$this->field} field must be a number";
  }
}