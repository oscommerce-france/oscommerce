<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
*/

  class osC_Boxes_shopping_cart extends osC_Modules {
    var $_title,
        $_code = 'shopping_cart',
        $_author_name = 'osCommerce',
        $_author_www = 'http://www.oscommerce.com',
        $_group = 'boxes';

    function osC_Boxes_shopping_cart() {
      global $osC_Language;

      $this->_title = $osC_Language->get('box_shopping_cart_heading');
    }

    function initialize() {
      global $osC_Language, $osC_ShoppingCart, $osC_Currencies;

      $this->_title_link = osc_href_link(FILENAME_CHECKOUT, null, 'SSL');

      if ($osC_ShoppingCart->hasContents()) {
        $this->_content = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';

        foreach ($osC_ShoppingCart->getProducts() as $products) {
          $this->_content .= '  <tr>' .
                             '    <td align="right" valign="top">' . $products['quantity'] . '&nbsp;x&nbsp;</td>' .
                             '    <td valign="top">' . osc_link_object(osc_href_link(FILENAME_PRODUCTS, $products['keyword']), $products['name']) . '</td>' .
                             '  </tr>';
        }

        $this->_content .= '</table>' .
                           '<p style="text-align: right">' . $osC_Language->get('box_shopping_cart_subtotal') . ' ' . $osC_Currencies->formatClean($osC_ShoppingCart->getSubTotal($osC_Currencies->getCode())) . '</p>';
      } else {
        $this->_content = $osC_Language->get('box_shopping_cart_empty');
      }
    }
  }
?>
