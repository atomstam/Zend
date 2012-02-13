<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @version    $Id: Json.php 23775 2011-03-01 17:25:24Z ralph $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Json */


/** Zend_Controller_Front */


/** Zend_View_Helper_Abstract.php */


/**
 * Helper for simplifying JSON responses
 *
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_View_Helper_Json extends Zend_View_Helper_Abstract
{
    /**
     * Encode data as JSON, disable layouts, and set response header
     *
     * If $keepLayouts is true, does not disable layouts.
     *
     * @param  mixed $data
     * @param  bool $keepLayouts
     * NOTE:   if boolean, establish $keepLayouts to true|false
     *         if array, admit params for Zend_Json::encode as enableJsonExprFinder=>true|false
     *         this array can contains a 'keepLayout'=>true|false
     *         that will not be passed to Zend_Json::encode method but will be used here
     * @return string|void
     */
    public function json($data, $keepLayouts = false)
    {
        $options = array();
        if (is_array($keepLayouts))
        {
            $options     = $keepLayouts;
            $keepLayouts = (array_key_exists('keepLayouts', $keepLayouts))
                            ? $keepLayouts['keepLayouts']
                            : false;
            unset($options['keepLayouts']);
        }

        $data = Zend_Json::encode($data, null, $options);
        if (!$keepLayouts) {

            $layout = Zend_Layout::getMvcInstance();
            if ($layout instanceof Zend_Layout) {
                $layout->disableLayout();
            }
        }

        $response = Zend_Controller_Front::getInstance()->getResponse();
        $response->setHeader('Content-Type', 'application/json', true);
        return $data;
    }
}
