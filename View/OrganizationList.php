<?php

namespace lwOrganizations\View;

class OrganizationList extends \LWmvc\View
{
    public function __construct()
    {
        parent::__construct($type);
        $this->setDic(new \lwOrganizations\Services\dic());
        $this->view = new \lw_view(dirname(__FILE__).'/templates/List.tpl.phtml');
    }
    
    public function render()
    {
        $this->view->newUrl = \lw_page::getInstance()->getUrl(array("cmd"=>"addForm"));
        return $this->view->render();
    }
}