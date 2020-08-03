<?php


namespace GraphSON;

class Singleton
{
    const jInt32 = 'g:Int32';
    const jDouble = 'g:Double';
    const jList = 'g:List';
    public int $id;

    public function getIdArray(): array
    {
        return [
            'id' => [
                '@type' => self::jInt32,
                '@value' => $this->id,
            ],
        ];
    }
}
