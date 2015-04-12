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
        "icon"    => "fa fa-facebook-square fa-lg"
    ];
}

if (isset($google_id) && isset($google_secret))
{
    $config['HybridAuth']['providers']['Google'] = [
        "enabled" => true,
        "keys"    => array("id" => $google_id, "secret" => $google_secret),
        "scope"   => "profile",
        "color"   => "#dd4b39",
        "icon"    => "fa fa-google-plus-square fa-lg"
    ];
}

if (isset($linkedin_id) && isset($linkedin_secret))
{
    $config['HybridAuth']['providers']['LinkedIn'] = [
        "enabled" => true,
        "keys"    => array("key" => $linkedin_id, "secret" => $linkedin_secret),
        "scope"   => "profile",
        "color"   => "#4875B4",
        "icon"    => "fa fa-linkedin-square fa-lg"
    ];
}

if (isset($twitter_id) && isset($twitter_secret))
{
    $config['HybridAuth']['providers']['Twitter'] = [
        "enabled" => true,
        "keys"    => array("id" => $twitter_id, "secret" => $twitter_secret),
        "scope"   => "profile",
        "color"   => "#33CCFF",
        "icon"    => "fa fa-twitter-square fa-lg"
    ];
}