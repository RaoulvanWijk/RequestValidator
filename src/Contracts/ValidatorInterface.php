<?php

namespace Raoul\Validator\Contracts;

interface ValidatorInterface
{
    public function validate($data, $rules = [], $messages = []);

    public function getErrors(): array;

    public function getError($key);

    public function hasErrors(): bool;

    public function getRules(): array;

    public function getRule($key);

    public function hasRules(): bool;

    public function getMessages(): array;

    public function getMessage($key);

    public function hasMessages(): bool;
}