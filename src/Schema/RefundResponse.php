<?php

namespace Omnipay\PowerTranz\Schema;

abstract class RefundResponse extends AuthResponse
{
    /**
     * Transaction Identifier of the original transaction (transaction being refunded)
     * @var string|null
     */
    public ?string $OriginalTrxnIdentifier;
}
