<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
*/
?>

<h1><?php echo osc_link_object(osc_href_link(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ($osC_MessageStack->size($osC_Template->getModule()) > 0) {
    echo $osC_MessageStack->output($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png', IMAGE_DELETE) . ' Batch Delete'; ?></div>
<div class="infoBoxContent">
  <form name="cDeleteBatch" action="<?php echo osc_href_link(FILENAME_DEFAULT, $osC_Template->getModule() . '=' . $_GET[$osC_Template->getModule()] . '&page=' . $_GET['page'] . '&action=batchDeleteZones'); ?>" method="post">

  <p><?php echo TEXT_DELETE_BATCH_ZONES_INTRO; ?></p>

<?php
  $check_address_book_flag = array();
  $check_tax_zones_flag = array();

  $Qzones = $osC_Database->query('select zone_id, zone_name, zone_code from :table_zones where zone_id in (":zone_id") order by zone_name');
  $Qzones->bindTable(':table_zones', TABLE_ZONES);
  $Qzones->bindRaw(':zone_id', implode('", "', array_unique(array_filter($_POST['batch'], 'is_numeric'))));
  $Qzones->execute();

  $names_string = '';

  while ($Qzones->next()) {
    $Qcheck = $osC_Database->query('select address_book_id from :table_address_book where entry_zone_id = :entry_zone_id limit 1');
    $Qcheck->bindTable(':table_address_book', TABLE_ADDRESS_BOOK);
    $Qcheck->bindInt(':entry_zone_id', $Qzones->valueInt('zone_id'));
    $Qcheck->execute();

    if ( $Qcheck->numberOfRows() === 1 ) {
      $check_address_book_flag[] = $Qzones->value('zone_name');
    }

    $Qcheck = $osC_Database->query('select association_id from :table_zones_to_geo_zones where zone_id = :zone_id limit 1');
    $Qcheck->bindTable(':table_zones_to_geo_zones', TABLE_ZONES_TO_GEO_ZONES);
    $Qcheck->bindInt(':zone_id', $Qzones->valueInt('zone_id'));
    $Qcheck->execute();

    if ( $Qcheck->numberOfRows() === 1 ) {
      $check_tax_zones_flag[] = $Qzones->value('zone_name');
    }

    $names_string .= osc_draw_hidden_field('batch[]', $Qzones->valueInt('zone_id')) . '<b>' . $Qzones->value('zone_name') . '</b>, ';
  }

  if ( !empty($names_string) ) {
    $names_string = substr($names_string, 0, -2) . osc_draw_hidden_field('subaction', 'confirm');
  }

  echo '<p>' . $names_string . '</p>';

  if ( empty($check_address_book_flag) && empty($check_tax_zones_flag) ) {
    echo '<p align="center"><input type="submit" value="' . IMAGE_DELETE . '" class="operationButton" /> <input type="button" value="' . IMAGE_CANCEL . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '=' . $_GET[$osC_Template->getModule()] . '&page=' . $_GET['page']) . '\';" class="operationButton" /></p>';
  } else {
    if ( !empty($check_address_book_flag) ) {
      echo '<p><b>' . TEXT_INFO_BATCH_DELETE_ZONES_PROHIBITED_ADDRESS_BOOK . '</b></p>' .
           '<p>' . implode(', ', $check_address_book_flag) . '</p>';
    }

    if ( !empty($check_tax_zones_flag) ) {
      echo '<p><b>' . TEXT_INFO_BATCH_DELETE_ZONES_PROHIBITED_TAX_ZONES . '</b></p>' .
           '<p>' . implode(', ', $check_tax_zones_flag) . '</p>';
    }

    echo '<p align="center"><input type="button" value="' . IMAGE_BACK . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '=' . $_GET[$osC_Template->getModule()] . '&page=' . $_GET['page']) . '\';" class="operationButton" /></p>';
  }
?>

  </form>
</div>