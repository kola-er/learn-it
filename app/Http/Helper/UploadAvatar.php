<?php

namespace Learn\Helper;

use Cloudder;

class UploadAvatar
{
	/**
	 * Upload a user's avatar to Cloudinary
	 *
	 * @param $avatar A user's avatar
	 * @return bool
	 */
    public static function uploadAvatar($avatar)
    {
        if (isset($avatar)) {
          Cloudder::upload($avatar);

          return Cloudder::getResult();
        } else {
            return false;
        }
    }
}
