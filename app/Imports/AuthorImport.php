<?php

namespace App\Imports;

use App\Helpers\Helpers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AuthorImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $authorRepo;
    public function __construct($authorRepo)
    {
        $this->authorRepo = $authorRepo;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $file = Helpers::getFileFromExcel($row['thumbnail']);
        $path = $this->authorRepo->storeAsImageAuthor($file);
        $data = [
            'name' => $row['name'],
            'description' => $row['description'],
            'thumbnail' => $path,
        ];
        return $this->authorRepo->create($data);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:100|unique:authors,name',
            'description' => 'required',
            'thumbnail' => 'required',
        ];
    }
}
