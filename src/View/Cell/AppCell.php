<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class AppCell extends Cell
{
    /**
     * @var array Helpers
     */
    public $helpers = [];

    /**
     * @param string $name Magic getter for helpers.
     *
     * @returns \Cake\View\Helper
     */
    public function __get($name)
    {
        if (in_array($name, $this->helpers))
        {
            $this->$name = $this->getView()
                                ->helpers()
                                ->load($name);
        }
        if (isset($this->helpers[$name]))
        {
            $this->$name = $this->getView()
                                ->helpers()
                                ->load($name, $this->helpers[$name]);
        }
        return $this->$name;
    }
}