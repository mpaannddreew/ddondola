<?php

namespace Shoppie\Rules;

use Illuminate\Contracts\Validation\Rule;
use Shoppie\ProductCategory;
use Shoppie\ProductSubCategory;

class ProductSubCategoryExists implements Rule
{
    /**
     * @var ProductCategory $category
     */
    protected $category;
    /**
     * Create a new rule instance.
     *
     * @param ProductCategory $category
     */
    public function __construct(ProductCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_null($this->category->categories->first(function (ProductSubCategory $category) use($value) {
            return trim(strtolower($category->name)) == trim(strtolower($value));
        }));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Category already has a sub category with this name.';
    }
}
