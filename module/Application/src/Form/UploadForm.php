<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 03-02-17
 * Time: 20:48.
 */

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter;

class UploadForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        // File Input
        $file = new Element\File('excel');
        $file->setLabel('Excel Upload');
        $file->setAttribute('id', 'excel');

        $this->add($file);

        $submit = new Element\Submit('submit');
        $submit->setValue('Upload');

        $this->add($submit);
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $fileInput = new InputFilter\FileInput('excel');
        $fileInput->setRequired(true);

        $fileInput->getValidatorChain()
            ->attachByName('filesize', ['max' => 2048000])
            ->attachByName('filemimetype', ['mimeType' => 'application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
            ->attachByName('Zend\Validator\File\Extension', ['extension' => ['xls', 'xlsx']]);

        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            [
                'target'               => './data/uploads/excel',
                'overwrite'            => false,
                'randomize'            => true,
                'use_upload_name'      => false,
                'use_upload_extension' => true,
            ]
        );
        $inputFilter->add($fileInput);

        $this->setInputFilter($inputFilter);
    }
}
