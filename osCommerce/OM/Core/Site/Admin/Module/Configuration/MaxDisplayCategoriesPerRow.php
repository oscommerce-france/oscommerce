<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Module\Configuration;

/**
 * @since v3.0.4
 */

  class MaxDisplayCategoriesPerRow extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    static protected $_sort = 1300;
    static protected $_default = '3';
    static protected $_group_id = 3;

    public function initialize() { }
  }
?>
