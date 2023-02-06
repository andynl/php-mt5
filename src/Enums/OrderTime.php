<?php
namespace Tarikh\PhpMeta\Enums;

class OrderTime
{
    /**
     * Good till Canceled.
     */
    const ORDER_TIME_GTC = 0;

    /**
     * Intraday
     */
    const ORDER_TIME_DAY = 1;

    /**
     * Specified time.
     */
    const ORDER_TIME_SPECIFIED = 2;

    /**
     * Specified day. The expiration time is 00:00 of the specified day or the nearest trading time.
     */
    const ORDER_TIME_SPECIFIED_DAY = 3;
    const ORDER_TIME_FIRST = null;
    const ORDER_TIME_LAST = null;
}
