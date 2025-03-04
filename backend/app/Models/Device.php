<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Device extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qr_code',
        'name',
        'serial_number',
        'product_id',
        'customer_id',
        'order_number',
        'warranty_months',
        'warranty_notes',
        'delivery_date',
        'installation_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'delivery_date' => 'date',
        'installation_date' => 'date',
        'warranty_months' => 'integer',
    ];

    /**
     * Get the product that the device belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the customer that owns the device.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the tickets for the device.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get the engineering notes for the device.
     */
    public function engineeringNotes(): HasMany
    {
        return $this->hasMany(EngineeringNote::class);
    }

    /**
     * Get the manuals for the device.
     */
    public function manuals(): BelongsToMany
    {
        return $this->belongsToMany(Manual::class);
    }

    /**
     * Get the categories for the device.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Scope a query to only include devices with a specific QR code.
     */
    public function scopeByQrCode($query, $code)
    {
        return $query->where('qr_code', $code);
    }

    /**
     * Check if the device is under warranty.
     */
    public function isUnderWarranty(): bool
    {
        if (!$this->delivery_date || !$this->warranty_months) {
            return false;
        }

        return now()->lessThan($this->delivery_date->addMonths($this->warranty_months));
    }

    /**
     * Get the warranty expiration date.
     */
    public function warrantyExpirationDate()
    {
        if (!$this->delivery_date || !$this->warranty_months) {
            return null;
        }

        return $this->delivery_date->addMonths($this->warranty_months);
    }
}
