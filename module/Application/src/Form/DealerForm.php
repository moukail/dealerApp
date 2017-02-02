<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 14:13
 */

namespace Application\Form;


use Zend\Form\Form;

class DealerForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('dealer');

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
}