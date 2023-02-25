<?php

namespace Raoul\Validator\Rules;

class Size implements \Raoul\Validator\Contracts\RuleInterface
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
      $this->msg = "The {$this->field} field must be exactly {$this->params[0]}";
      return $this->value == $this->params[0];
    } elseif(is_array($this->value)) {
      $this->msg = "The {$this->field} field must have exactly {$this->params[0]} items";
      return count($this->value) == $this->params[0];
    } elseif(is_string($this->value)) {
      $this->msg = "The {$this->field} field must be exactly {$this->params[0]} characters";
      return strlen($this->value) == $this->params[0];
    } else {
      $this->msg = "The {$this->field} field must be exactly {$this->params[0]}";
      return false;
    }
  }

  public function getMessage(): string
  {
    return $this->msg;
  }
}