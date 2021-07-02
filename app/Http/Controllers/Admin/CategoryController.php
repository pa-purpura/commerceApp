<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use UploadAble;

    public function index()
    {
        $categories = Category::all();

        $this->setPageTitle('Categories', 'List of all categories');
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();

        $this->setPageTitle('Categories', 'Create Category');
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:90',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        try {
              $collection = collect($params);

              $image = null;

              if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                  $image = $this->uploadOne($params['image'], 'categories');
              }

              $featured = $collection->has('featured') ? 1 : 0;
              $menu = $collection->has('menu') ? 1 : 0;

              $merge = $collection->merge(compact('menu', 'image', 'featured'));

              $category = new Category($merge->all());

              $category->save();

        } catch (QueryException $exception) {
              throw new InvalidArgumentException($exception->getMessage());
        }

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $targetCategory = Category::findOrFail($id);
        $categories = Category::all();

        $this->setPageTitle('Categories', 'Edit Category : '.$targetCategory->name);
        return view('admin.categories.edit', compact('categories', 'targetCategory'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $targetId = $params['id'];

        $category = Category::where('id', $targetId)->first();
        $collection = collect($params)->except('_token');

        $image = null;

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($category->image != null) {
                $this->deleteOne($category->image);
            }

            $image = $this->uploadOne($params['image'], 'categories');
        }

        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;

        $merge = $collection->merge(compact('menu', 'image', 'featured'));

        $category->update($merge->all());

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category updated successfully' ,'success',false, false);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category deleted successfully' ,'success',false, false);
    }

// end of class
}
