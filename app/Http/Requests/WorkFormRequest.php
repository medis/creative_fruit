<?php
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;

class WorkFormRequest extends Request
{
    /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
    public function authorize() {
        return Auth::check();
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules() {
        return [
          'title' => 'required|unique:works|max:255',
          'title' => array('Regex:/^[A-Za-z0-9 ]+$/'),
          'video' => array('Regex:/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/'),
          'body' => 'required',
        ];
    }
}
