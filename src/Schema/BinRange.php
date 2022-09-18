<?php

namespace Omnipay\PowerTranz\Schema;

class BinRange extends AbstractSchema
{
    /**
     * CardType Id
     * @var int|null
     */
    public ?int $CardTypeId;

    /**
     * Card brand (Visa, Mastercard,etc.)
     * @var string|null
     */
    public ?string $CardBrand;

    /**
     * Bin range start value
     * @var string|null
     */
    public ?string $RangeStart;

    /**
     * Bin range end value
     * @var string|null
     */
    public ?string $RangeEnd;

    /**
     * Indicates whether the card is Local Debit
     * @var bool|null
     */
    public ?bool $LocalDebit;
}
