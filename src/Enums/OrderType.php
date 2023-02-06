<?php
namespace Tarikh\PhpMeta\Enums;

class OrderType
{
    const OP_BUY = 0;
    const OP_SELL = 1;
    const OP_BUY_LIMIT = 2;
    const OP_SELL_LIMIT = 3;
    const OP_BUY_STOP = 4;
    const OP_SELL_STOP = 5;
    const OP_BUY_STOP_LIMIT = 6;
    const OP_SELL_STOP_LIMIT = 7;
    const OP_CLOSE_BY = 8;
}
