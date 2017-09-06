<?php namespace App\Repos\Dbrepos;

Interface CategoryDbRepoInterface {

    public function insertCategory($requestData);
    public function updateCategory($slug, $requestData);
    public function getCategoryList();

}