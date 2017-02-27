<?php

/**
 * Status Constants
 *
 * @author Vinod Mohan
 *
 * @category Constants
 */
namespace AppBundle\Constants;

class GeneralState
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    const STATUS_ORDER_CANCELLED = 0;
    const STATUS_ORDER_ACTIVE = 1;
    const STATUS_ORDER_CONFIRMED = 2;
    const STATUS_ORDER_DELIVERED = 3;
}
