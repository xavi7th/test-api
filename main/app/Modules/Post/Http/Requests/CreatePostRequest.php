<?php

namespace App\Modules\Post\Http\Requests;

use App\Modules\Post\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => ['required', 'string', 'max:191'],
      'description' => ['required', 'string', 'max:191'],
      'content' => ['required', 'string'],
    ];
  }

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  public function createPost(): Post
  {
    return $this->website->posts()->create($this->validated());
  }
}
