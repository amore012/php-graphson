<?php


namespace GraphSON;

class Property extends Singleton
{
    public int $id;
    public string $propertyLabel;
    public $propertyValue;
    public string $propertyType;

    /**
     * GraphSONProperty constructor.
     *
     * @param $propertyLabel
     * @param $propertyValue
     * @param string $propertyType
     */
    public function __construct(string $propertyLabel, $propertyValue, string $propertyType = '')
    {
        $this->propertyLabel = $propertyLabel;
        $this->propertyValue = $propertyValue;
        if (empty($propertyType)) {
        }
    }


    /**
     * Maps a PHP Data Type to a JAVA core data type
     * @link https://tinkerpop.apache.org/docs/3.4.7/dev/io/#_core_2
     *
     * @param $propertyValue
     */
    public function getPropertyTypeStringFromPropertyValue($propertyValue)
    {
        $type = gettype($propertyValue);
        switch ($type) {
            case "boolean":
            case "integer":
                $this->propertyType = self::jInt32; //Might need to check that the integer is not bigger than 32 bits
                break;
            case "double":
                $this->propertyType = self::jDouble;
                break;
            case "array":
                $this->propertyType = self::jList;
                break;
            case "NULL":
            case "object":
            case "resource":
            case "resource (closed)":
            case "unknown type":
            case "string":
            default:
                break;
        }
        return $this->propertyType;
    }

    public function graphSONPropertyToString(): string
    {
        return '{
        "@type" : "g:Property",
        "@value" : { 
            "key" : "' . $this->propertyLabel . '",
            "value" : { 
                "@type" : "' . $this->propertyType . '",
                "@value" : ' . $this->propertyValue . ' 
            }
        }';
    }

}
