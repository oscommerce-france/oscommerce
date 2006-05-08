<?php
/*
  $Id:address_book.php 187 2005-09-14 14:22:13 +0200 (Mi, 14 Sep 2005) hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License
*/
?>

<?php echo tep_image(DIR_WS_IMAGES . 'table_background_address_book.gif', $osC_Template->getPageTitle(), HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'class="pageIcon"'); ?>

<h1><?php echo $osC_Template->getPageTitle(); ?></h1>

<?php
  if ($messageStack->size('address_book') > 0) {
    echo $messageStack->output('address_book');
  }
?>

<div class="moduleBox">
  <div class="outsideHeading"><?php echo $osC_Language->get('primary_address_title'); ?></div>

  <div class="content">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td valign="top"><?php echo $osC_Language->get('primary_address_description'); ?></td>
        <td valign="top" align="center"><?php echo '<b>' . $osC_Language->get('primary_address_title') . '</b><br />' . tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
        <td valign="top"><?php echo tep_address_label($osC_Customer->getID(), $osC_Customer->getDefaultAddressID(), true, ' ', '<br />'); ?></td>
      </tr>
    </table>
  </div>
</div>

<div class="moduleBox">
  <div class="outsideHeading"><?php echo $osC_Language->get('address_book_title'); ?></div>

  <div class="content">
    <table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  $Qaddresses = osC_AddressBook::getListing();

  while ($Qaddresses->next()) {
    $format_id = tep_get_address_format_id($Qaddresses->valueInt('country_id'));
?>

      <tr class="moduleRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">
        <td>
          <b><?php echo $Qaddresses->valueProtected('firstname') . ' ' . $Qaddresses->valueProtected('lastname'); ?></b>

<?php
    if ($Qaddresses->valueInt('address_book_id') == $osC_Customer->getDefaultAddressID()) {
      echo '&nbsp;<small><i>' . $osC_Language->get('primary_address_marker') . '</i></small>';
    }
?>

        </td>
        <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, 'address_book=' . $Qaddresses->valueInt('address_book_id') . '&edit', 'SSL') . '">' . tep_image_button('small_edit.gif', $osC_Language->get('button_edit')) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_ACCOUNT, 'address_book=' . $Qaddresses->valueInt('address_book_id') . '&delete', 'SSL') . '">' . tep_image_button('small_delete.gif', $osC_Language->get('button_delete')) . '</a>'; ?></td>
      </tr>
      <tr>
        <td colspan="2" style="padding: 0px 0px 10px 10px;"><?php echo tep_address_format($format_id, $Qaddresses->toArray(), true, ' ', '<br />'); ?></td>
      </tr>

<?php
  }
?>

    </table>
  </div>
</div>

<div class="submitFormButtons">
  <span style="float: right;">
<?php
  if ($Qaddresses->numberOfRows() < MAX_ADDRESS_BOOK_ENTRIES) {
    echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, 'address_book&new', 'SSL') . '">' . tep_image_button('button_add_address.gif', $osC_Language->get('button_add_address')) . '</a>';
  } else {
    echo sprintf($osC_Language->get('address_book_maximum_entries'), MAX_ADDRESS_BOOK_ENTRIES);
  }
?>
  </span>

  <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', $osC_Language->get('button_back')) . '</a>'; ?>
</div>