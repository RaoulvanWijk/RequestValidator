<?php

namespace Raoul\Validator\Rules;

class RequiredIf implements \Raoul\Validator\Contracts\RuleInterface
{
  protected $field;
  protected $value;
  protected $params;
  protected $data;

  private $msg;
  public function __construct($field, $value, $params, $data)
  {
    $this->field = $field;
    $this->value = $value;
    $this->params = $params;
    $this->data = $data;
  }
  public function validate(): bool
  {
    if (isset($this->data[$this->params[0]]) && $this->data[$this->params[0]] == $this->params[1]) {
      return !empty($this->value);
    }
    return true;
  }

  public function getMessage(): string
  {
    return "The {$this->field} field is required if {$this->params[0]} is {$this->params[1]}";
  }
}