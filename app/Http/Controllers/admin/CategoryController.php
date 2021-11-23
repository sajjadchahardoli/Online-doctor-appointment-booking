<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(20);
        return view('admin.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'فیلد عنوان را وارد کنید.',
            'slug.unique' => 'فیلد نام مستعار تکراری است',
            'slug.required' => 'فیلد نام مستعار اجباری است '
        ];
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ], $messages);

        $category = new Category();
        try {
            $category->create($request->all());
        } catch (Exception $exception) {
            switch ($exception->getCode()) {
                case 2300:
                    $msg = 'نام مستعار وارد شده تکراری است';
                    break;

            }
            return redirect(route('admin.categories.create'))->with('warning', $msg);

        }
        $msg = 'ذخیره دسته بندی با موفقیت انجام شد';
        return redirect(route('admin.categories'))->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $messages = [
            'name.required' => 'فیلد عنوان را وارد کنید.',
            'slug.unique' => 'فیلد نام مستعار تکراری است',
            'slug.required' => 'فیلد نام مستعار اجباری است '
        ];
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ], $messages);

        $category = new Category();
        try {
            $category->update($request->all());
        } catch (Exception $exception) {
            switch ($exception->getCode()) {
                case 2300:
                    $msg = 'نام مستعار وارد شده تکراری است';
                    break;

            }
            return redirect(route('admin.categories.edit'));

        }
        $msg = 'ذخیره دسته بندی با موفقیت انجام شد';
        return redirect(route('admin.categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (Exception $exception) {
            return redirect(route('admin.categories'))->with('warning', $exception->getFile());
        }
        $msg = 'ایتم مورد نظر حذف شد';
        return redirect(route('admin.categories'))->with('success', $msg);
    }
}
