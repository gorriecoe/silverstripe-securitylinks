<?php

namespace gorriecoe\SecurityLinks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Security;

/**
 * Adds a login, logout and lost password link type to Link Object.
 *
 * @package silverstripe-securitylinks
 */
class SecurityLinksExtension extends DataExtension
{
    /**
     * A map of object types that can be linked to
     * Custom dataobjects can be added to this
     *
     * @var array
     **/
    private static $types = [
        'Login' => 'Login link',
        'Logout' => 'Logout link',
        'LostPassword' => 'Lost password link',
    ];

    /**
     * Update LinkURL
     */
    public function updateLinkURL(&$linkURL)
    {
        $owner = $this->owner;
        switch ($owner->Type) {
            case 'Login':
                if (!Security::getCurrentUser()) {
                    $linkURL = Security::login_url();
                }
                break;
            case 'Logout':
                if (Security::getCurrentUser()) {
                    $linkURL = Security::logout_url();
                }
                break;
            case 'LostPassword':
                $linkURL = Security::lost_password_url();
                break;
        }
    }
}
