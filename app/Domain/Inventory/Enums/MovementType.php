<?php

namespace App\Domain\Inventory\Enums;

enum MovementType: string
{
    case ENTRY = 'in';
    case EXIT = 'out';
}
