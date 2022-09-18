<?php

namespace Omnipay\PowerTranz\Schema;

use Omnipay\PowerTranz\Message\AbstractResponse;

abstract class AuthResponse extends AbstractResponse
{
    use AuthTrait;
}
