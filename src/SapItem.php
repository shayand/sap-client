<?php


namespace shayand\sapClient;


class SapItem
{

    public $key;
    public $label;
    public $machineName;

    /**
     * SapItem constructor.
     * @param $key
     * @param $label
     * @param $machineName
     */
    public function __construct( $machineName, $key, $label )
    {
        $this->key = $key;
        $this->label = $label;
        $this->machineName = $machineName;
    }

}