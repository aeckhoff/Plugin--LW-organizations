<?php

namespace lwOrganizations\View;

class OrganizationForm extends \LWmvc\View
{
    public function __construct($type)
    {
        parent::__construct($type);
        $this->view = new \lw_view(dirname(__FILE__).'/templates/Form.tpl.phtml');
    }

    public function render()
    {
        return parent::baseCrudFormRender("showList");
    }
}