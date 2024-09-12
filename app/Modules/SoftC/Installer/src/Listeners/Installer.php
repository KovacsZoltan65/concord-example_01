<?php

namespace Webkul\Installer\Listeners;

use GuzzleHttp\Client;
use Webkul\User\Repositories\UserRepository;

class Installer
{
    protected const API_ENDPOINT = 'https://updates.krayincrm.com/api/updates';
}