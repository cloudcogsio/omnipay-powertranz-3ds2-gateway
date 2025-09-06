<?php

namespace Omnipay\PowerTranz\Schema;

trait SchemaTraits
{
    /**
     * @throws \ReflectionException
     */
    protected function hydrate(array $data, string $parent)
    {
        $nestedData = [];
        $reflection = new \ReflectionClass($parent);
        foreach ($data as $key => $value)
        {
            $paramType = ($reflection->hasProperty($key)) ? $reflection->getProperty($key)->getType()->getName() : false;

            if (is_array($value))
            {
                // Special case 'Errors' key (due to PHP not supporting typed arrays) we need to check if this key exits and convert members to Error objects
                if ($key == 'Errors')
                {
                    $errors = [];
                    foreach ($value as $errorData)
                    {
                        $errors[] = new Error((array) $errorData);
                    }
                    $nestedData[$key] = $errors;
                }
                else {
                    if ($paramType && class_exists($paramType)) {
                        $nestedObject = $this->hydrate($value, $paramType);
                        $nestedData[$key] = $nestedObject;
                    }
                }
            }
            else {
                switch ($paramType)
                {
                    case 'float':
                        $value = round($value,2);
                        break;
                }

                $nestedData[$key] = $value;
            }
        }

        $object = ($parent != get_called_class()) ? new $parent($nestedData) : $this;
        foreach ($nestedData as $key => $value) @$object->$key = $value;

        //TODO - Undeclared properties show deprecated notice.
        // Review classes implementing trait to ensure all properties are declared.
        foreach ($nestedData as $key => $value) @$object->$key = $value;

        return $object;
    }

    /**
     * @throws \JsonException
     */
    public function __toString()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    }

    public static function getSchemaProperties() : array
    {
        $properties = [];
        $class = new \ReflectionClass(get_called_class());
        foreach ($class->getProperties() as $property)
        {
            $properties[] = $property->getName();
        }

        return $properties;
    }

    public function toArray() : array {
        return $this->recursiveReflection($this);
    }

    protected function recursiveReflection(object $object) : array
    {
        $data = [];

        $class = new \ReflectionClass($object);
        foreach ($class->getProperties() as $property)
        {
            if ($property->isPublic() && $property->isInitialized($object))
            {
                $value = $property->getValue($object);

                if (is_object($value)) {
                    $data[$property->getName()] = $this->recursiveReflection($value);
                } else {
                    $data[$property->getName()] = $value;
                }
            }
        }

        return $data;
    }
}