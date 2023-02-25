<?php

namespace Raoul\Validator\Rules;

class Date implements \Raoul\Validator\Contracts\RuleInterface
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
    $date = date_parse($this->value);
    if($date['error_count'] > 0) {
      return false;
    }
    if($date['warning_count'] > 0) {
      return false;
    }
    if($date['year'] < 1000 || $date['year'] > 9999) {
      return false;
    }
    if($date['month'] < 1 || $date['month'] > 12) {
      return false;
    }
    if($date['day'] < 1 || $date['day'] > 31) {
      return false;
    }
    return true;
  }

  public function getMessage(): string
  {
    return "The {$this->field} field must be a valid date";
  }
}