<?php

namespace App\Models\User\Traits\Attribute;

/**
 * Trait SocialAccountAttribute
 * @package App\Models\User\Traits\Attribute
 */
trait SocialAccountAttribute
{
    /**
     * @return bool|string
     */
    public function getUrlAttribute()
    {
        switch ($this->provider) {
            case 'facebook':
                return 'http://facebook.com/' . $this->provider_user_id;
            case 'vkontakte':
                return 'http://vk.com/id' . $this->provider_user_id;
            case 'twitter':
                return 'https://twitter.com/' . $this->nickname;
            case 'odnoklassniki':
                return 'https://ok.ru/profile/' . $this->provider_user_id;
            case 'google':
                return 'https://plus.google.com/u/0/' . $this->provider_user_id;
            default:
                return false;
        }
    }
}
