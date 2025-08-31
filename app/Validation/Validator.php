<?php

namespace App\Validation;


use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;


class Validator {

	protected $errors;

	public function validate(Request $request, array $rules)
	{
		$args = $request->getParsedBody();
		foreach ($rules as $field => $rule) {
			
			try {
				$rule->setName(ucfirst($field))->assert($args[$field]);
			} catch (NestedValidationException $exception) {
				$this->errors[$field] = $exception->getMessages();
			}
		}

		$_SESSION["errors"] = $this->errors;
		return $this;
	}


	public function failed(): bool
	{
		return !empty($this->errors);
	}


	public function getErrors()
	{
		return $this->errors;
	}
}