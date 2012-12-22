<?php
/*
 -------------------------------------------------------------------------
 Piwik plugin for GLPI
 Copyright (C) 2012, Vincent DILLENSCHNEIDER

  -------------------------------------------------------------------------

 LICENSE
		
 This file is part of Piwik.

 Piwik is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Piwik is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Piwik. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */
 
	if (!defined('GLPI_ROOT')) {
		define('GLPI_ROOT', '../../..');
		include (GLPI_ROOT . "/inc/includes.php");
	}
	$config = new PluginPiwikConfig();
	$config->GetFromDB(1);
	$url = str_replace('http://','',$config->fields["url"]);
	$url = $config->fields["url"];
	$id_site = $config->fields["id_site"];
	
?>
jQuery(document).ready(function () {
  var pkBaseURL =  "<?php echo $url;?>";
  jQuery.getScript(pkBaseURL + 'piwik.js', function(){
	var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", <?php echo $id_site;?>);
	piwikTracker.trackPageView();
	piwikTracker.enableLinkTracking();
  });
});
