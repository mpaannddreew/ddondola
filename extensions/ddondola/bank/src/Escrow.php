<?php

namespace Bank;


use Ddondola\EcryptableModel;
use Illuminate\Support\Str;

class Escrow extends EcryptableModel
{
    protected $fillable = ['amount', 'source_account_id', 'destination_account_id', 'meta', 'completed', 'reversed', 'code'];

    protected $encryptable = ['amount'];

    protected $casts = [
        'completed' => 'bool',
        'reversed' => 'bool',
        'meta' => 'array'
    ];

    /**
     * Account from which escrow is initiated
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source() {
        return $this->belongsTo(Account::class, 'source_account_id');
    }

    /**
     * Account to which escrow is intended
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination() {
        return $this->belongsTo(Account::class, 'destination_account_id');
    }

    /**
     * Check if escrow is settled (reversed or completed)
     *
     * @return bool
     */
    public function settled() {
        return $this->completed || $this->reversed;
    }

    /**
     * Get meta item
     *
     * @param $item
     * @return mixed
     */
    public function meta($item) {
        return collect($this->meta)->get($item);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = \Illuminate\Support\Str::uuid()->toString();
        });
    }

    public function miniCode() {
        return Str::upper(collect(explode('-', $this->code))->first());
    }
}
