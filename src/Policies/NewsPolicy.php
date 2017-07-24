<?php

namespace Baytek\Laravel\Content\Types\News\Policies;

use Baytek\Laravel\Content\Policies\GeneralPolicy;

use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy extends GeneralPolicy
{
    public $contentType = 'News';
}
