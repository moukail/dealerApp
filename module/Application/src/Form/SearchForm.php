<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 04-02-17
 * Time: 01:39
 */

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class SearchForm extends Form
{
    // TODO elastic search

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        $this->addElements();
    }

    public function addElements()
    {
        $this->add([
            'type' => Element\Search::class,
            'name' => 'search',
            'options' => [
                'label' => 'Search',
            ],
        ]);

        $submit = new Element\Submit('submit');
        $submit->setValue('Search');

        $this->add($submit);
    }
}