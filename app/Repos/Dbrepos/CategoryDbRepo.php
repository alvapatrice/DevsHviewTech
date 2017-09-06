<?php namespace App\Repos\Dbrepos;

use App\Category;

class CategoryDbRepo implements CategoryDbRepoInterface {

    protected $category;

    public function __construct()
    {
        $this->category = new Category;
    }
    public function insertCategory($requestData)
    {
        $category = new Category;

        $category->title= $requestData['title'];
        $category->slug= $requestData['slug'];
        $category->description= $requestData['description'];
        $category->parent_id= $requestData['parent'];

        return $category->save();
    }

    public function updateCategory($slug, $requestData)
    {
        $category = Category::where('slug', $slug)->first();

        $category->title= $requestData['title'];
        $category->slug= $requestData['slug'];
        $category->description= $requestData['description'];
        $category->parent_id= $requestData['parent'];

        return $category->save();

    }

    public function getCategoryBySlug($slug)
    {
        return $this->category->where('slug', $slug)->first();
    }

    public function getCategoryList($limit = 12)
    {
        $parents = $this->category->take($limit)->get(['id', 'title', 'slug', 'parent_id']);

        $parentsWithChildren = [];

        foreach($parents as $parent)
        {
            $parentsWithChildren[] = $this->getCategoryWithChildren($parent->slug);
        }
        return $parentsWithChildren;

    }

    public function getCategoryListAll()
    {
        $categories = $this->category->get(['id', 'title', 'slug', 'parent_id']);

        $cats = [];

        foreach($categories as $category)
        {
            $cats[] = $this->getCategoryWithChildren($category->slug);
        }
        return $cats;
    }
    public function getPaginatedList($limit)
    {
        return $this->category->paginate($limit);

    }
    public function getCategoryWithChildren($slug)
    {
        $categories = $this->category->where('slug', $slug)
                        ->with('children', 'children.children',
                                'children.children.children',
                                'children.children.children.children',
                                'children.children.children.children.children')
                        ->first();

        $cat_array = [];
        $cat_array[] = $categories;
        $categories = $categories['children'];
        if($categories == null)
        {
            return $cat_array;
        }
        if(! $categories->count() )
        {
            return $cat_array;
        }

        foreach($categories as $category)
        {
                $temp = [];
                $temp = $this->getChildren($category, $temp);
                $cat_array = array_merge($cat_array, $temp);
        }
        return $cat_array;
    }


    protected function getChildren($category, $data)
    {
        $data[] = $category;
        if(! $category['children']->count())
        {
            return $data;
        }
        $data = $this->getChildren($category['children'][0], $data);
        return $data;
    }

    public function getCategoryBreadCrumb($article)
    {
        $category_nested = $this->category->where('id', $article->category_id)
            ->with('parent', 'parent.parent',
                'parent.parent.parent', 'parent.parent.parent.parent',
                'parent.parent.parent.parent.parent')
            ->get()->toArray();


        $breadcrumb = [];
        $breadcrumb[] = $category_nested[0];
        $x = 0;
        while ($x <5)
        {
            if( $breadcrumb[$x]['parent'] == null)
            {
                break;
            }
            $breadcrumb[] = $breadcrumb[$x]['parent'];
            $x++;
        }
        return array_reverse($breadcrumb);
    }

}