<?php

namespace Omnipay\PowerTranz\Schema;

class VoidRequest extends AbstractSchema
{
    public string $TransactionIdentifier;
    public ?string $ExternalIdentifier;
    public ?string $ExternalGroupIdentifier;
    public ?string $EmvData;
    public string $TerminalCode;
    public ?string $TerminalSerialNumber;
    public bool $AutoReversal = false;
}
