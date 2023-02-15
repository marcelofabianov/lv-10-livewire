<?php

declare(strict_types=1);

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Latte\Uuid;

final class User extends Authenticatable
{
    use HasApiTokens;
    use HasUuids;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    const DELETED_AT = 'deletedAt';

    protected $table = 'users';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'inactivatedAt',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'inactivatedAt',
    ];

    public function newUniqueId(): string
    {
        return Uuid::random()->getValue();
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}
