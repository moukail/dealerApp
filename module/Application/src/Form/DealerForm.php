<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 14:13
 */

namespace Application\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Form;
use Zend\Validator\StringLength;
use Zend\InputFilter;

class DealerForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);
        $this->add([
            'name' => 'city',
            'type' => 'text',
            'options' => [
                'label' => 'City',
            ],
        ]);
        $this->add([
            'name' => 'meta1',
            'type' => 'text',
            'options' => [
                'label' => 'Meta1',
            ],
        ]);
        $this->add([
            'name' => 'meta2',
            'type' => 'text',
            'options' => [
                'label' => 'Meta2',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }

    private function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'city',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $this->setInputFilter($inputFilter);

    }
}