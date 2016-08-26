<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;

class ContactFormRequest extends Request
{
    /**
   * Let everyone submit form.
   */
    public function authorize() {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules() {
        return [
          'name' => 'required|max:512',
          'email' => 'required|email',
          'body' => 'required'
        ];
    }
}
