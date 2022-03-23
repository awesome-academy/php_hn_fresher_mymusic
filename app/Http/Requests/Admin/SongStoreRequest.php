<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SongStoreRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:255', 'unique:songs,name'],
            'thumbnail' => ['required', 'image'],
            'song' => ['required', 'mimes:mp3'],
            'description' => ['required'],
            'album_id' => ['nullable', 'exists:albums,id'],
            'author_id' => ['nullable', 'exists:authors,id'],
            'durations' => ['required'],
        ];
    }
}
