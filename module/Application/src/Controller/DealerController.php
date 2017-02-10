<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 13:39
 */

namespace Application\Controller;

use Application\Entity\Dealer;
use Application\Form\DealerForm;
use Application\Form\UploadForm;
use Application\Service\DealerService;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DealerController extends AbstractActionController
{
    /**
     * @var DealerService $dealerService
     */
    private $dealerService;

    /**
     * DealerController constructor.
     * @param DealerService $dealerService
     */
    public function __construct(DealerService $dealerService)
    {
        $this->dealerService = $dealerService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'dealers' => $this->dealerService->findAllDealers()
        ));
    }

    public function addAction()
    {
        $form = new DealerForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return [ 'form' => $form ];
        }


        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return [ 'form' => $form ];
        }

        $dealer = new Dealer();
        $dealer->exchangeArray($form->getData());
        $this->dealerService->saveDealer($dealer);
        return $this->redirect()->toRoute('dealer');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('dealer', [ 'action' => 'add' ]);
        }

        try {
            $dealer = $this->dealerService->getDealer($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('dealer', [ 'action' => 'index' ]);
        }

        if(!$dealer){
            return $this->redirect()->toRoute('dealer');
        }

        $form = new DealerForm();
        $form->bind($dealer);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->dealerService->saveDealer($dealer);

        return $this->redirect()->toRoute('dealer', [ 'action' => 'index' ]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('dealer');
        }

        $request = $this->getRequest();
        $dealer = $this->dealerService->getDealer($id);

        if(!$dealer){
            return $this->redirect()->toRoute('dealer');
        }

        if (!$request->isPost()) {

            return [
                'id'    => $id,
                'dealer' => $dealer,
            ];

        }

        $del = $request->getPost('del', 'No');

        if ($del == 'Yes') {
            $id = (int) $request->getPost('id');
            $this->dealerService->deleteDealer($id);
        }

        return $this->redirect()->toRoute('dealer');
    }

    public function importAction()
    {
        $form = new UploadForm('upload-form');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );

        $form->setData($post);
        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $data = $form->getData();

        $inputFileName = $data['excel']['tmp_name'];

        $this->dealerService->import($inputFileName);

        //TODO show success message
        return $this->redirect()->toRoute('dealer');
    }

    public function exportAction()
    {
        $result = $this->dealerService->export();

        $response = $this->getEvent()->getResponse();
        $response->getHeaders()->clearHeaders()->addHeaders( array(
            'Pragma' => 'public',
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="dealers.xls"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Transfer-Encoding' => 'binary',
        ) );
        $response->setContent($result);
        return $response;
    }
}