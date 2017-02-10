<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 13:43
 */

namespace Application\Service;

use Application\Entity\Dealer;
use Doctrine\ORM\EntityManager;
use Exception;
use PHPExcel;
use PHPExcel_IOFactory;

class DealerService
{

    /**
     * @var EntityManager $entitymanager
     */
    private $entitymanager;

    /**
     * FeedService constructor.
     * @param EntityManager $entitymanager
     */
    public function __construct(EntityManager $entitymanager)
    {
        $this->entitymanager = $entitymanager;
    }


    /**
     * @param Dealer $dealer
     */
    public function saveDealer($dealer)
    {
        $dealer2 = $this->entitymanager->getRepository('Application\Entity\Dealer')->findOneBy(array('id' => $dealer->getId()));
        if (!$dealer2) {
            $this->entitymanager->persist($dealer);
        }

        $this->entitymanager->flush();
    }

    /**
     * @param $id
     */
    public function deleteDealer($id)
    {
        $dealer = $this->entitymanager->find('Application\Entity\Dealer', $id);
        if ($dealer) {
            $this->entitymanager->remove($dealer);
            $this->entitymanager->flush();
        }
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getDealer($id)
    {
        return $this->entitymanager->getRepository('Application\Entity\Dealer')->findOneBy(['id' => $id]);
    }

    /**
     * @return array
     */
    public function findAllDealers()
    {
        return $this->entitymanager->getRepository('Application\Entity\Dealer')->findAll();
    }

    /**
     * @return string
     */
    public function export()
    {
        $stack = [];

        $result = $this->findAllDealers();
        foreach ($result as $key => $value){
            array_push($stack, $result[$key]->getArrayCopy());
        }

        /** @var PHPExcel $objPHPExcel */
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->fromArray($stack);
        $objPHPExcel->getActiveSheet()->removeColumn('A');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_start();
        $objWriter->save('php://output');

        return ob_get_clean();

    }

    /**
     * @param $inputFileName
     */
    public function import($inputFileName)
    {
        //  TODO test the other formats
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            echo 'Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage();
        }

        // TODO refactoring and header check
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++){
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $dealer = new Dealer();
            $dealer->setName($rowData[0][0]);
            $dealer->setCity($rowData[0][1]);
            $dealer->setMeta1($rowData[0][2]);
            $dealer->setMeta2($rowData[0][3]);

            $this->saveDealer($dealer);
        }
    }
}