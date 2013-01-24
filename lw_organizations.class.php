<?php

class lw_organizations extends lw_plugin
{
    public function __construct()
    {
        parent::__construct();
        include_once(dirname(__FILE__).'/Services/Autoloader.php');
        $autoloader = new \lwOrganizations\Services\Autoloader();
        $autoloader->setConfig($this->config);
    }
    
    public function buildPageOutput()
    {
        $controller = new \lwOrganizations\Controller\BackendController();
        $response = $controller->execute();
        if ($response->getParameterByKey('cmd')) {
            $url = lw_page::getInstance()->getUrl($response->getParameterArray());
            $this->pageReload($url);
        }
        else {
            return $response->getOutputByKey('output');
        }
    }
}