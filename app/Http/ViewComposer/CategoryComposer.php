<?php
namespace App\Http\ViewComposer;
use Illuminate\View\View;
use App\Category;

class CategoryComposer{
    protected $categories;
    public function __construct(Category $categories)
    {
        $this->categories=$categories;
    }
    public function compose(View $view){
        return $view->with('categories',$this->categories->all());
    }
}