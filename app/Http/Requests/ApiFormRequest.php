<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 *
 */
abstract class ApiFormRequest extends FormRequest
{

    protected function failedValidation(Validator $validator): never
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    abstract public function authorize(): bool;

    abstract public function rules(): array;
}
