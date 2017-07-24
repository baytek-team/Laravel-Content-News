<?php

namespace Baytek\Laravel\Content\Types\News\Policies;

use Baytek\Laravel\Content\Policies\GeneralPolicy;

use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy extends GeneralPolicy
{
    public $contentType = 'News Category';
}
