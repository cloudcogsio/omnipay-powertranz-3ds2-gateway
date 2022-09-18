<?php

namespace Omnipay\PowerTranz\Schema;

abstract class AbstractSchema
{
    use SchemaTraits;

    /**
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        $this->hydrate($data, get_called_class());
    }
}
