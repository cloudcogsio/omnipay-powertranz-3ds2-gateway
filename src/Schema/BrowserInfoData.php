<?php

namespace Omnipay\PowerTranz\Schema;

class BrowserInfoData extends AbstractSchema
{
    public ?string $AcceptHeader;
    public ?string $Language;
    public ?string $ScreenHeight;
    public ?string $ScreenWidth;
    public ?string $TimeZone;
    public ?string $UserAgent;
    public ?string $IP;
    public ?bool $JavaEnabled;
    public ?bool $JavascriptEnabled;
    public ?string $ColorDepth;
}
