<?php

namespace Omnipay\PowerTranz\Schema;

abstract class CaptureResponse extends AuthResponse
{
    /**
     * Transaction Identifier of the original transaction (transaction being captured)
     * @var string|null
     */
    public ?string $OriginalTrxnIdentifier;
}
