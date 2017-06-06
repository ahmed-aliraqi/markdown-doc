<?php

namespace App\Http\Requests;

use App\Page;
use App\Project;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method() == 'POST'){
            return $this->user()->can('create', Page::class);
        }elseif ($this->method() == 'PUT'){
            return $this->user()->can('update', $this->route('page'));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('pages.attributes');
    }
}
