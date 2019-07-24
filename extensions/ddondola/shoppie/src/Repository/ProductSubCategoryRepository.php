<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-11-20
 * Time: 1:27 PM
 */

namespace Shoppie\Repository;


use Shoppie\ProductCategory as Category;
use Shoppie\ProductSubCategory as SubCategory;

class ProductSubCategoryRepository
{
    /**
     * Existing category from id
     *
     * @param $id
     * @return SubCategory
     */
    public function id($id) {
        return SubCategory::find($id);
    }

    /**
     * Existing category from code
     *
     * @param $code
     * @return SubCategory
     */
    public function code($code) {
        return SubCategory::where('code', $code)->first();
    }

    /**
     * @param Category $category
     * @param $name
     * @param null $description
     * @return \Illuminate\Database\Eloquent\Model|SubCategory
     */
    public function create(Category $category, $name, $description = null) {
        return $category->categories()->create([
            'name' => $name, 'description' => $description
        ]);
    }

    /**
     * @param SubCategory $category
     * @param $update
     * @return SubCategory
     */
    public function update(SubCategory $category, $update) {
        $category->update($update);

        return $category;
    }
}