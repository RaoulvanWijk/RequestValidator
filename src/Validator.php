<?php

namespace Raoul\Validator;

use Raoul\Validator\Contracts\ValidatorInterface;
use Raoul\Validator\Exceptions\RuleException;
use Raoul\Validator\Exceptions\ValidationException;

class Validator implements ValidatorInterface
{
    protected array $errors = [];
    protected array $rules = [];
    protected array $messages = [];

    public function __construct()
    {
        $this->rules = $this->getRules();
    }

  /**
   * @throws RuleException
   * @throws ValidationException
   */
  public function validate($data, $rules = [], $messages = []): static
  {
        if(!empty($rules)) {
            $this->rules = $rules;
        }
        if(!empty($messages)) {
            $this->messages = $messages;
        }
        $this->errors = [];

        foreach($this->rules as $field => $rules) {
            if(is_string($rules)) {
                $rules = explode('|', $rules);
            } elseif(!is_array($rules)) {
                continue;
            }

            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $ruleName = $rule[0];
                $params = $rule[1] ?? '';
                $ruleClass = "Raoul\\Validator\\Rules\\".strtoupper($ruleName);
                if(!class_exists($ruleClass)) {
                    throw new RuleException("Rule {$ruleName} does not exist");
                }
                $rule = new $ruleClass($field, $data[$field] ?? null, explode(',', $params), $data);
                if(!$rule->validate()) {
                  if($this->getMessage($field.'.'.$ruleName)) {
                    $this->errors[$field][] = $this->getMessage($field.'.'.$ruleName);
                    continue;
                  } else {
                    $this->errors[$field][] = $rule->getMessage();
                    continue;
                  }
                }
            }


        }
        if($this->hasErrors()) {
            throw new ValidationException($this->getErrors(), $this->getMessages());
        }

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getError($key)
    {
        return $this->errors[$key] ?? null;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getRules(): array
    {
        if(method_exists($this, 'rules')) {
            return array_merge($this->rules, $this->rules());
        }
        return $this->rules;
    }

    public function getRule($key)
    {
        return $this->rules[$key] ?? null;
    }

    public function hasRules(): bool
    {
        return !empty($this->rules);
    }

    public function getMessages(): array
    {
        if(method_exists($this, 'messages')) {
            return array_merge($this->messages, $this->messages());
        }
        return $this->messages;
    }

    public function getMessage($key)
    {
        return $this->messages[$key] ?? null;
    }

    public function hasMessages(): bool
    {
        return !empty($this->messages);
    }
}