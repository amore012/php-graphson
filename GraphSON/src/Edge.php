<?php


namespace GraphSON;

class Edge extends Singleton
{
    public string $relationship;

    public function __construct(string $relationship, int $inVertexId, array $properties = [])
    {
        $this->relationship = $relationship;
        $this->inVertexId = $inVertexId;
        if (!empty($properties)) {
            $this->appendProperties();
        }
    }

    public function generateOutEdgeString()
    {
        ;
    }

    public function appendProperties(array $properties = [])
    {
        foreach ($properties as $property) {
            $this->properties[] = new Property();
        }
    }
}
