<?php

namespace App\Models\User;

use App\Models\User\Traits\Attribute\SocialAccountAttribute;
use App\Models\User\Traits\Relationship\SocialAccountRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialAccount
 * @package App\Models\User
 */
class SocialAccount extends Model
{
    use SocialAccountRelationship, SocialAccountAttribute;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'nickname'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];
}
