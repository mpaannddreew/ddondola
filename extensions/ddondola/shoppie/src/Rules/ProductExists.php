<?php

namespace Shoppie\Rules;

use Illuminate\Contracts\Validation\Rule;
use Shoppie\Product;
use Shoppie\Shop;

class ProductExists implements Rule
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
        return is_null($this->shop->products->first(function (Product $product) use($value) {
            return trim(strtolower($product->name)) == trim(strtolower($value));
        }));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Shop already has a product with this name.';
    }
}
