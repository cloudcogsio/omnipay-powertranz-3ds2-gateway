<?php

namespace Omnipay\PowerTranz\Schema;

/**
 * Nonfinancial request (for Risk Management for example)
 */
class NonfinancialRequest extends AuthRequest
{
    /**
     * If true, tokenizes and returns the tokenized PAN
     * @var bool|null
     */
    public ?bool $Tokenize;
}
