<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorStoreRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array {
    return [
      'name' => 'required|string|max:190',
      'email' => 'required|string|email|max:190',
      'phone' => 'required|string|max:190',
      'message' => 'required|string|max:190'
    ];
  }
}
