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

  class CfgAppGzip extends \osCommerce\OM\Core\Site\Admin\Module\ConfigurationAbstract {
    static protected $_sort = 100;
    static protected $_default = '/usr/bin/gzip';
    static protected $_group_id = 18;

    public function initialize() { }
  }
?>