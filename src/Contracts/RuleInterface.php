<?php

namespace Raoul\Validator\Contracts;

interface RuleInterface
{
    public function validate(): bool;

    public function getMessage(): string;
}
