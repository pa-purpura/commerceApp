<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Brand;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    use UploadAble;

    public function index()
    {
        $brands = Brand::all();

        $this->setPageTitle('Brands', 'List of all brands');
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $this->setPageTitle('Brands', 'Create Brand');
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:90',
            'logo'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        try {
              $collection = collect($params);

              $logo = null;

              if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {
                  $image = $this->uploadOne($params['logo'], 'brands');
              }

              $merge = $collection->merge(compact('logo'));

              $brand = new Brand($merge->all());

              $brand->save();

        } catch (QueryException $exception) {
              throw new InvalidArgumentException($exception->getMessage());
        }

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while creating brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Brand added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $targetBrand = Brand::findOrFail($id);
        // $categories = Brand::all();

        $this->setPageTitle('Brands', 'Edit Brand : '.$targetBrand->name);
        return view('admin.brands.edit', compact('targetBrand'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'logo'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $targetId = $params['id'];

        $brand = Brand::where('id', $targetId)->first();
        $collection = collect($params)->except('_token');

        $logo = null;

        if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {

            if ($category->image != null) {
                $this->deleteOne($category->image);
            }

            $image = $this->uploadOne($params['logo'], 'brands');
        }

        $merge = $collection->merge(compact('logo'));

        $brand->update($merge->all());

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while updating brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Brand updated successfully' ,'success',false, false);
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while deleting brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Brand deleted successfully' ,'success',false, false);
    }
    // end of class
}
