<?php
namespace Tarikh\PhpMeta\Enums;

class OrderFilling
{
    /**
     * Fill or Kill. An order must be filled completely or canceled. This type of filling is automatically set for the instant and request execution. This type can also be used for market and exchange execution, depending on the IMTConSymbol::FillFlags symbol setting.
     */
    const ORDER_FILL_FOK = 0;

    /**
     * Immediate or Cancel. An order can be filled partially and the residual volume is canceled. This filling type can be used for market orders with market execution and for all order types with exchange execution. The availability of the type is determined by the IMTConSymbol::FillFlags symbol setting.
     */
    const ORDER_FILL_IOC = 1;

    /**
     * Return the remainder to the queue. This mode is used for pending orders. It can be used for market orders only with exchange execution.
     */
    const ORDER_FILL_RETURN = 2;
}
