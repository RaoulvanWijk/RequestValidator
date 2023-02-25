<?php

namespace Raoul\Validator\Rules;

class Regex implements \Raoul\Validator\Contracts\RuleInterface
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
    return preg_match($this->params[0], $this->value);
  }

  public function getMessage(): string
  {
    return "The {$this->field} field is invalid";
  }
}