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
use Zend\Http\Client;

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

        /** @var \PHPExcel $objPHPExcel */
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getActiveSheet()->fromArray($stack);
        $objPHPExcel->getActiveSheet()->removeColumn('A');

        /** @var \PHPExcel_Writer_Excel2007 $objWriter */
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
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
        $objPHPExcel = new \PHPExcel();
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(\Exception $e) {
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

    /**
     * @param $fileId
     * @param $token
     */
    public function importgdrive($fileId, $token)
    {
        // curl --header "Authorization: Bearer ya29.GlzxA32KfX69gkULfC9WIs105_oUucdF324PL3SYQoR9ZBUO_Mcn7CBZWxU5CA-xd4pgDXITaN3IBX7c5FwugAp33xfHxbOTyTmF_3qGA3wIsssd1Vg-_NN9cRbD-g" https://www.googleapis.com/drive/v3/files/0B7IYCRyGKuBNdGhPMDA1Nl9RZkU?alt=media -o /var/www/symfony.xls
        // docker-compose run web2 curl --header "Authorization: Bearer ya29.GlzxA32KfX69gkULfC9WIs105_oUucdF324PL3SYQoR9ZBUO_Mcn7CBZWxU5CA-xd4pgDXITaN3IBX7c5FwugAp33xfHxbOTyTmF_3qGA3wIsssd1Vg-_NN9cRbD-g" https://www.googleapis.com/drive/v3/files/0B7IYCRyGKuBNdGhPMDA1Nl9RZkU?alt=media -o /var/www/symfony.xls

        //$info = pathinfo($filename);
        $filename = 'dealers' . uniqid('_') . '.xls';

        $fp = fopen ('/var/www/data/uploads/' . $filename, 'x+');
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/drive/v3/files/" . $fileId . "?alt=media");
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization: Bearer ' . $token));
        curl_setopt($ch, CURLOPT_FILE, $fp);
        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);


        $this->import('/var/www/data/uploads/' . $filename);

        return ['status' => 'succes'];
    }

}