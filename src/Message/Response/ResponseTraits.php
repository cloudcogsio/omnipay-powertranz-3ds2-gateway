<?php

namespace Omnipay\PowerTranz\Message\Response;

use Omnipay\PowerTranz\Schema\AuthTrait;

trait ResponseTraits
{
    use AuthTrait;

    public function getTransactionType() : ?int {
        return $this->TransactionType ?? null;
    }

    public function isSuccessful(): bool
    {
        return $this->Approved;
    }

    public function getMessage(): ?string
    {
        return $this->ResponseMessage ?? null;
    }

    public function getCode(): ?string
    {
        return $this->IsoResponseCode ?? null;
    }

    public function getTransactionId(): ?string
    {
        return $this->OrderIdentifier ?? null;
    }

    public function getTransactionReference(): ?string
    {
        return $this->TransactionIdentifier ?? null;
    }

    public function getOriginalTransactionReference(): ?string
    {
        return $this->OriginalTrxnIdentifier ?? null;
    }
}
