<?php

namespace Omnipay\PowerTranz\Support;

class StatusReason
{
    public static function lookup(string $code) : ?string
    {
        $data = [
            "01" => "Card authentication failed",
            "02" => "Unknown Device",
            "03" => "Unsupported Device",
            "04" => "Exceeds authentication frequency limit",
            "05" => "Expired card",
            "06" => "Invalid card number",
            "07" => "Invalid transaction",
            "08" => "No Card record",
            "09" => "Security failure",
            "10" => "Stolen card",
            "11" => "Suspected fraud",
            "12" => "Transaction not permitted to cardholder",
            "13" => "Cardholder not enrolled in service",
            "17" => "High confidence",
            "18" => "Very high confidence",
            "19" => "Exceeds ACS maximum challenges",
            "20" => "Non-Payment transaction not supported",
            "21" => "3RI transaction not supported",
        ];

        return ($data[$code]) ?? "Undefined";
    }
}
