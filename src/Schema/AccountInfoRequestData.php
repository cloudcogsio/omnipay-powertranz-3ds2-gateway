<?php

namespace Omnipay\PowerTranz\Schema;

class AccountInfoRequestData extends AbstractSchema
{
    public ?string $AccountAgeIndicator;
    public ?string $AccountChangeDate;
    public ?string $AccountChangeIndicator;
    public ?string $AccountDate;
    public ?string $AccountPasswordChangeDate;
    public ?string $AccountPasswordChangeIndicator;
    public ?string $AccountPurchaseCount;
    public ?string $AccountProvisioningAttempts;
    public ?string $AccountDayTransactions;
    public ?string $AccountYearTransactions;
    public ?string $PaymentAccountAge;
    public ?string $PaymentAccountAgeIndicator;
    public ?string $ShipAddressUsageDate;
    public ?string $ShipAddressUsageIndicator;
    public ?string $ShipNameIndicator;
    public ?string $SuspiciousAccountActivity;
}
