<?php

namespace App\Repositories\Admin\Author;

use App\Repositories\Admin\BaseRepositoryInterface;

interface AuthorRepoInterface extends BaseRepositoryInterface
{
    //Get author with song and album belongs to this author
    public function getAuthorWithSongAndAlbum($id);

    // Store Image to Storage
    public function storeAsImageAuthor($file);

    // Delete all song of this author by author id
    public function deleteSongOfAuthor($id);

    // Delete all album of this author by author id
    public function deleteALbumsOfAuthor($id);
}
