<?php
/*
  osCommerce Online Merchant $osCommerce-SIG$
  Copyright (c) 2010 osCommerce (http://www.oscommerce.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  namespace osCommerce\OM\Core\Site\Website\Application\Developers\Action;

  use osCommerce\OM\Core\ApplicationAbstract;

  class Roadmap {
    public static function execute(ApplicationAbstract $application) {
      $application->developersPage = 'roadmap_april';
    }
  }
?>
