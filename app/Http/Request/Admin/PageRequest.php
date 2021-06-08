<?php
/**
 *  app/Http/Request/Admin/PageRequest.php
 *
 * User: 
 * Date-Time: 17.12.20
 * Time: 17:57
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->page)],
        ];
    }
}
