<?php
use Cake\Core\Configure;

/**
 * Store your social secret keys in this .gitignore file.
 */
include 'hybridauth.secret.php';

$config['HybridAuth'] = [
    "providers"  => [],
    'debug_mode' => Configure::read('debug'),
    'debug_file' => LOGS.'hybridauth.log',
];

if (isset($facebook_id) && isset($facebook_secret))
{
    $config['HybridAuth']['providers']['Facebook'] = [
        "enabled" => true,
        "keys"    => array("id" => $facebook_id, "secret" => $facebook_secret),
        "scope"   => "public_profile",
        "color"   => "#3b5998",
        "icon"    => "fa fa-facebook fa-lg"
        //"scope"   => "email, user_about_me, user_birthday, user_hometown"
    ];
}

if (isset($google_id) && isset($google_secret))
{
    $config['HybridAuth']['providers']['Google'] = [
        "enabled" => true,
        "keys"    => array("id" => $google_id, "secret" => $google_secret),
        "scope"   => "",
        "color"   => "#dd4b39",
        "icon"    => "fa fa-google-plus fa-lg"
    ];
}