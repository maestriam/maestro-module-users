<?php

namespace Maestro\Users\Support\Enums;

enum PageEnum : string
{
    case USER_HOME  = 'users.pages.user-home';
    case USER_INFO  = 'users.pages.user-info';
    case USER_INDEX = 'users.pages.user-index';
}