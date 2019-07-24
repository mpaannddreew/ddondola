<?php

namespace Shoppie\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Shoppie\Shop;

class ShopExists implements Rule
{
    /**
     * @var Model $seller
     */
    protected $seller;


    /**
     * Create a new rule instance.
     *
     * @param Model $seller
     */
    public function __construct(Model $seller)
    {
        $this->seller = $seller;
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
        return is_null($this->seller->shops->first(function (Shop $shop) use($value) {
            return trim(strtolower($shop->name)) == trim(strtolower($value));
        }));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You already have a shop with this name.';
    }
}
