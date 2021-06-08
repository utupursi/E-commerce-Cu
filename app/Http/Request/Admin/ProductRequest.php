<?php
/**
 *  app/Http/Request/Admin/ProductRequest.php
 *
 * User:
 * Date-Time: 15.12.20
 * Time: 15:24
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'category' => 'required|integer',
            'position' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'slug' => ['required','alpha_dash', Rule::unique('products', 'slug')->ignore($this->product)],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ];
    }
}
