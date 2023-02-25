<?php

namespace Raoul\Validator\Rules;

class Max implements \Raoul\Validator\Contracts\RuleInterface
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
    return strlen($this->value) <= $this->params[0];
  }

  public function getMessage(): string
  {
    return "The {$this->field} field must be at most {$this->params[0]} characters";
  }
}