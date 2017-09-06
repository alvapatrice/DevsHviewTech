<?php namespace App\Repos\Dbrepos;

Interface TagDbRepoInterface {

    public function insertTag($requestData);
    public function updateTag($slug, $requestData);

}