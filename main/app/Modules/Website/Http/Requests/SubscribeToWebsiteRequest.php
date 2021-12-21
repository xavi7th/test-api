<?php

namespace App\Modules\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Subscriber\Models\Subscriber;

class SubscribeToWebsiteRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'email' => ['required', 'email']
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

  public function subscribeUserToWebsite()
  {
    $subscriber = Subscriber::where('email', $this->email)->first();

    if (! $subscriber) {
      $subscriber = Subscriber::create(['email' => $this->email]);
    }

    $this->website->subscribers()->syncWithoutDetaching([$subscriber->id]);
  }
}
