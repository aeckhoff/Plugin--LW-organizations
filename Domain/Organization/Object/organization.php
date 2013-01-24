<?php

namespace lwOrganizations\Domain\Organization\Object;

class organization extends \LWddd\Entity
{
    public function __construct($id=false)
    {
        parent::__construct($id);
    }
    
    public function renderView($view)
    {
        $view->entity = $this->getValues();
    }    
}