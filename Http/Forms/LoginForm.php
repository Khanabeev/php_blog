<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($attributes['password'], min: 3, max: 10)) {
            $this->errors['password'] = 'Password invalid';
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): LoginForm
    {
        $this->errors[$field] = $message;
        return $this;
    }

    public function throw()
    {
        ValidationException::throw($this->errors, $this->attributes);
    }


}