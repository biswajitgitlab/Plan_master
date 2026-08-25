<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidDynamicForm implements ValidationRule
{
    protected $schema;

    public function __construct($schema)
    {
        $this->schema = $schema;
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($this->schema)) {
            return;
        }

        if (!is_array($value)) {
            $fail('The form data must be an array.');
            return;
        }

        foreach ($this->schema as $field) {
            $fieldName = $field['name'];
            $isRequired = !empty($field['required']);
            
            if ($isRequired && empty($value[$fieldName])) {
                $fail("The {$field['label']} field is required.");
            }
            
            if (!empty($value[$fieldName])) {
                if ($field['type'] === 'email' && !filter_var($value[$fieldName], FILTER_VALIDATE_EMAIL)) {
                    $fail("The {$field['label']} field must be a valid email.");
                }
                if ($field['type'] === 'number' && !is_numeric($value[$fieldName])) {
                    $fail("The {$field['label']} field must be a number.");
                }
            }
        }
    }
}
