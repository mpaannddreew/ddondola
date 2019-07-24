<?php

namespace Shoppie\Rules;

use Illuminate\Contracts\Validation\Rule;
use Shoppie\ProductCategory;
use Shoppie\Shop;

class ProductCategoryExists implements Rule
{
    /**
     * @var Shop $shop
     */
    protected $shop;

    /**
     * Create a new rule instance.
     *
     * @param Shop $shop
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
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
        return is_null($this->shop->categories->first(function (ProductCategory $category) use($value) {
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
        return 'Shop already has a product category with this name.';
    }
}
