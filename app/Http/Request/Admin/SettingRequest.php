<?php
/**
 *  app/Http/Request/Admin/SettingRequest.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 10:29
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->user()->can('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|string|max:255'
        ];
    }
}
