<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['user_id', 'quantity', 'type', 'note'];

    /**
     * Product stock belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Person who triggered this stock increase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addedBy() {
        return $this->belongsTo(config('shoppie.seller'), 'user_id');
    }

    /**
     * Check if this record reduced stock
     *
     * @return bool
     */
    public function isOut() {
        return strtolower($this->type) == 'out';
    }

    /**
     * Check if this record increased stock
     *
     * @return bool
     */
    public function isIn() {
        return !$this->isOut();
    }
}
