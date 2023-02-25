<?php

namespace Raoul\Validator\Rules;

class Between implements \Raoul\Validator\Contracts\RuleInterface
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
    if(is_numeric($this->value)) {
      $this->msg = "The {$this->field} field must be between {$this->params[0]} and {$this->params[1]}";
      return $this->value >= $this->params[0] && $this->value <= $this->params[1];
    } elseif(is_array($this->value)) {
      $this->msg = "The {$this->field} field must have between {$this->params[0]} and {$this->params[1]} items";
      return count($this->value) >= $this->params[0] && count($this->value) <= $this->params[1];
    } elseif(is_string($this->value)) {
      $this->msg = "The {$this->field} field must be between {$this->params[0]} and {$this->params[1]} characters";
      return strlen($this->value) >= $this->params[0] && strlen($this->value) <= $this->params[1];
    } else {
      $this->msg = "The {$this->field} field must be between {$this->params[0]} and {$this->params[1]}";
      return false;
    }
  }

  public function getMessage(): string
  {
    return $this->msg;
  }
}