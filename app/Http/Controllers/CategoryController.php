<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('title', 'LIKE', "%{$value}%");
                });
            });
        });


        $Categories = QueryBuilder::for(Category::class)
            ->defaultSort('title')
            ->allowedFilters(['title', $globalSearch])
            ->where('status',true)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Pdf/Category/Categories', [
            'Categories' => $Categories,
        ])->table(function (InertiaTable $table) {
            $table
              ->withGlobalSearch()
              ->defaultSort('title')
              ->column(key: 'title', searchable: true, sortable: true, canBeHidden: false)
              ->column(key:'actions',label: 'Actions')
              ->selectFilter(key: 'title', label: 'Title', options: [
                  'en' => 'English',
                  'nl' => 'Dutch',
              ]);
        });
    }

    public function createCategory()
    {
        return Inertia::render('Pdf/Category/CreateCategory', [

        ]);
    }
    public function storeCategory(Request $request)
    {
        $request->validate([ 'title'=>'required|unique:categories']);
        // 'email' => 'unique:users,email_address,' . $userId,
        $category = new Category();

        $category->title = $request->title;
        $category->status = true;
        $category->save();
        return response()->json(['status'=>true]);
    }
    public function deleteCategory(Request $request)
    {
       $category = Category::where('id',$request->id)->delete();
       return response()->json(['status'=>true]);
    }
    public function editCategory(Request $request)
    {

        $category = Category::where('id',$request->id)->first();
        return Inertia::render('Pdf/Category/EditCategory', [
         'Category'=>$category
        ]);
    }
    public function updateCategory(Request $request)
    {
        $request->validate([ 'title'=>'required|unique:categories,title,'.$request->id]);
        // 'email' => 'unique:users,email_address,' . $userId,
        $category = Category::where('id',$request->id)->first();

        $category->title = $request->title;
        $category->save();
        return response()->json(['status'=>true]);
    }


}
