<?php


namespace GraphSON;

class Vertex extends Singleton
{
    public int $id;
    public string $label;
    public array $outEdges;
    private $properties;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function toGraphSONString()
    {
        $vertexArray = [
            'id' => [
                '@type' => self::jInt32,
                '@value' => $this->id,
            ],
            'label' => $this->label
        ];
        $string = '{';
        '{"id":{"@type":"g:Int32","@value":1},"label":"person","outE":{"created":[{"id":{"@type":"g:Int32","@value":9},"inV":{"@type":"g:Int32","@value":3},"properties":{"weight":{"@type":"g:Double","@value":0.4}}}],"knows":[{"id":{"@type":"g:Int32","@value":7},"inV":{"@type":"g:Int32","@value":2},"properties":{"weight":{"@type":"g:Double","@value":0.5}}},{"id":{"@type":"g:Int32","@value":8},"inV":{"@type":"g:Int32","@value":4},"properties":{"weight":{"@type":"g:Double","@value":1.0}}}]},"properties":{"name":[{"id":{"@type":"g:Int64","@value":0},"value":"marko"}],"age":[{"id":{"@type":"g:Int64","@value":1},"value":{"@type":"g:Int32","@value":29}}]}}';
        $string .= '"id":{"@type":"g:Int32","@value":' . $this->id . '}';
        if (isset($this->label)) {
            $string .= ', "label":"' . $this->label . '"';
        }
        /** @var GraphSONEdge $outEdge */
        foreach ($this->outEdges as $outEdge) {
            $vertexArray['OutE'][] = $outEdge;
        }

        /** @var GraphSONVertexProperty $vertexProperties */
        foreach ($this->properties as $vertexProperties) {

        }


        return json_encode($vertexArray);
    }
}
