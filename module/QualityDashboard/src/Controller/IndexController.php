<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 14-3-17
 * Time: 15:15
 */

namespace QualityDashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
