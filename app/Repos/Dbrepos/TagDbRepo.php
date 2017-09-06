<?php namespace App\Repos\Dbrepos;

use App\Tag;

class TagDbRepo implements TagDbRepoInterface {

    public function insertTag($requestData)
    {
        return Tag::insert([
            'title' => $requestData['title'],
            'slug' => $requestData['slug'],
            'description' => $requestData['description']
        ]);
    }
    public function getPaginatedList($limit)
    {
        return Tag::paginate($limit);
    }
    public function updateTag($slug, $requestData)
    {
        return Tag::where('slug', $slug)
            ->update([
                'title' => $requestData['title'],
                'slug' => $requestData['slug'],
                'description' => $requestData['description']
            ]);
    }

}