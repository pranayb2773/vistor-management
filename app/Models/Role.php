<?php

namespace App\Models;

use App\Enums\GuardName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'description',
    ];

    protected $casts = [
        'guard_name' => GuardName::class,
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => ucwords($value),
        );
    }

    public function scopeSuperAdmin(Builder $query): Builder
    {
        return $query->where('name', 'Super Admin');
    }
}
