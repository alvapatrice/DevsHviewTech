<?php namespace App\Repos\Dbrepos;

Interface PostDbRepoInterface {

    public function getBySlug($slug);

    public function getColumns(Array $columns);

    public function updatePost($slug, $requestData);

    public function insertPost($requestData);

    public function searchArticles($requestData, array $colums);

}