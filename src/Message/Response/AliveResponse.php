<?php

namespace Omnipay\PowerTranz\Message\Response;

use Omnipay\PowerTranz\Message\AbstractResponse;

class AliveResponse extends AbstractResponse
{
    public ?string $Affinity;
    public ?string $ApiVersion;
    public ?string $AssemblyVersion;
    public ?string $Name;
    public ?string $Type;

    public function isSuccessful(): bool
    {
        return true;
    }
}
