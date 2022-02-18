<?php

namespace App\Entities;

class InputData
{
    /** @var string */
    public $actionType;

    /** @var string */
    public $actionDepth;

    public function __construct(string $action, string $depth = null){
        $this->setActionType($action);
        $this->setActionDepth($depth);
    }

    public function setActionType(string $action) : void
    {
        $this->actionType  = $action;
    }

    public function getActionType() : string
    {
        return $this->actionType;
    }

    public function setActionDepth(?int $actionDepth) : void
    {
        $this->actionDepth  = $actionDepth;
    }

    public function getActionDepth() : ?int
    {
        return $this->actionDepth;
    }
}
