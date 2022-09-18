<?php

namespace Omnipay\PowerTranz\Schema;

class RefundRequest extends AuthRequest
{
    /**
     * Indicates whether the transaction is a Refund (true) or a Credit (false)
     * @var bool
     */
    public bool $Refund = true;
}
