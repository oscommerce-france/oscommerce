<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core;

  abstract class ApplicationAbstract {
    protected $_page_contents = 'main.php';
    protected $_page_title;
    protected $_ignored_actions = array();

    public function __construct() {
      $this->initialize();

      $this->runActions();
    }

    public function getPageTitle() {
      return $this->_page_title;
    }

    public function setPageTitle($title) {
      $this->_page_title = $title;
    }

    public function getPageContent() {
      return $this->_page_contents;
    }

    public function setPageContent($filename) {
      $this->_page_contents = $filename;
    }

    public function siteApplicationActionExists($action) {
      return class_exists('osCommerce\\OM\\Core\\Site\\' . OSCOM::getSite() . '\\Application\\' . OSCOM::getSiteApplication() . '\\Action\\' . $action);
    }

    public function ignoreAction($key) {
      $this->_ignored_actions[] = $key;
    }

    public function runActions() {
      $action = null;
      $action_index = 1;

      if ( count($_GET) > 1 ) {
        $requested_action = HTML::sanitize(basename(key(array_slice($_GET, 1, 1, true))));

        if ( $requested_action == OSCOM::getSiteApplication() ) {
          $requested_action = null;

          if ( count($_GET) > 2 ) {
            $requested_action = HTML::sanitize(basename(key(array_slice($_GET, 2, 1, true))));

            $action_index = 2;
          }
        }

        if ( !empty($requested_action) && self::siteApplicationActionExists($requested_action) ) {
          $action = $requested_action;
        }
      }

      if ( isset($action) ) {
        call_user_func(array('osCommerce\\OM\\Core\\Site\\' . OSCOM::getSite() . '\\Application\\' . OSCOM::getSiteApplication() . '\\Action\\' . $action, 'execute'), $this);

        $action_index++;

        if ( $action_index < count($_GET) ) {
          $action = array($action);

          for ( $i = $action_index, $n = count($_GET); $i < $n; $i++ ) {
            $subaction = HTML::sanitize(basename(key(array_slice($_GET, $i, 1, true))));

            if ( !in_array($subaction, $this->_ignored_actions) && self::siteApplicationActionExists(implode('\\', $action) . '\\' . $subaction) ) {
              call_user_func(array('osCommerce\\OM\\Core\\Site\\' . OSCOM::getSite() . '\\Application\\' . OSCOM::getSiteApplication() . '\\Action\\' . implode('\\', $action) . '\\' . $subaction, 'execute'), $this);

              $action[] = $subaction;
            } else {
              break;
            }
          }
        }
      }
    }
  }
?>
