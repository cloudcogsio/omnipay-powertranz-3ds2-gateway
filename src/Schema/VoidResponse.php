<?php

namespace Omnipay\PowerTranz\Schema;

abstract class VoidResponse extends AuthResponse
{
    /**
     * Transaction Identifier of the original transaction (transaction being voided)
     * @var string|null
     */
    public ?string $OriginalTrxnIdentifier;
}
