<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SongUpdateRequest extends SongStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'name' => ['required', 'max:255', 'unique:songs,name,' . $this->route('song')],
            'thumbnail' => ['nullable', 'image'],
            'song' => ['nullable', 'mimes:mp3'],
        ]);
    }
}
