<?php

namespace Maestro\Users\Support\Enums;

enum EventsEnum : string
{
    case USER_REMOVING = 'maestro.jobs.users.purged';
}