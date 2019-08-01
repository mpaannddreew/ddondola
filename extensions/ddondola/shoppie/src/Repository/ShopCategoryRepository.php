<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-11-20
 * Time: 1:27 PM
 */

namespace Shoppie\Repository;



use Shoppie\ShopCategory as Category;

class ShopCategoryRepository
{
    public function all() {
        return Category::all();
    }

    /**
     * Existing category from id
     *
     * @param $id
     * @return Category
     */
    public function id($id) {
        return Category::find($id);
    }

    /**
     * Existing category from code
     *
     * @param $code
     * @return Category
     */
    public function code($code) {
        return Category::where('code', $code)->first();
    }

    /**
     * New category
     *
     * @param $name
     * @param null $description
     * @return Category
     */
    public function create($name, $description = null) {
        return Category::create([
            'name' => $name, 'description' => $description
        ]);
    }

    public function update(Category $category, array $attributes) {
        $category->update($attributes);

        return $category;
    }

    public function builder() {
        return Category::select();
    }
}