<?php

namespace App\Enums;

enum MovementType: string
{
    case ENTRY = 'in';
    case EXIT = 'out';
}
