<?php


namespace Gremlin;


class VertexProperty extends Property
{
    const jType = 'g:VertexProperty';

    public function getPropertyStringFromPropertyValue($propertyValue)
    {
        $return = '
        {
            "@type" : "g:VertexProperty",
            "@value" : {
            "id" : {
                "@type" : "' . self::jInt32 . '",
                "@value" : ' . $this->id . '
            },
            "value" : "' . $this->propertyValue . '",
            "label" : "' . $this->propertyLabel . '"';
        $return .= '}';
        return $return;
    }


    public function getPropertyArray($propertyValue)
    {
        $array = [
            '@type' => self::jType,
            '@value' => [

            ],
        ];
        $return = '
        {
            "@type" : "g:VertexProperty",
            "@value" : {
            "id" : {
                "@type" : "' . self::jInt32 . '",
                "@value" : ' . $this->id . '
            },
            "value" : "' . $this->propertyValue . '",
            "label" : "' . $this->propertyLabel . '"';
        $return .= '}';
        return $return;
    }

    public function processVertexPropertiesToString(array $kvArray = [])
    {
        $propertyString = '';
        if (!empty($kvArray)) {
            $propertyString .= '"properties" : {';
            foreach ($kvArray as $key => $value) {
                $propertyString .= '"' . $key . '" : {
                "@type" : "' . $this->propertyType . '",
                "@value" : ';
                if (is_array($value) && $this->propertyType == self::jList) {
                    $propertyString .= '[{';
                    foreach ($value as $setPropVal) {
                        $propertyString .= '"@type" : "' . $this->getPropertyTypeStringFromPropertyValue(
                                $setPropVal
                            ) . '"';
                        $propertyString .= '"@value" : "' . $setPropVal . '"';
                    }
                    $propertyString .= "}]";
                } else {
                    $propertyString .= '"@value" : "' . $this->propertyValue . '"';
                }
            }
        }
    }
}
