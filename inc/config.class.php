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
	die("Sorry. You can't access directly to this file");
}

class PluginPiwikConfig extends CommonDBTM {
   // From CommonDBTM
   public $table            = 'glpi_plugin_piwik';
   public $type             = 'PluginPiwik';
   
	function showForm () {
      global $CFG_GLPI,$LANG;

      echo "<form name='form' method='post' action='".$this->getFormURL()."'>";
      echo "<div align='center'><table class='tab_cadre_fixe'  cellspacing='2' cellpadding='2'>";
      echo "<tr><th colspan='2'>".$LANG['plugin_piwik']['setup']."</th></tr>";
      echo "<tr class='tab_bg_1 top'><td>".$LANG['plugin_piwik']['id_piwik'].": </td>";
      echo "<td><input type='text' name='id_site' size='5' value='".$this->fields["id_site"]."'/>";
      echo "</td></tr>";	  
      echo "<tr class='tab_bg_1 top'><td>".$LANG['plugin_piwik']['url_piwik'].": </td>";
      echo "<td><input type='text' name='url' size='100' value='".$this->fields["url"]."'/>";
      echo "</td></tr>";
      echo "<tr class='tab_bg_1 top'><td>".$LANG['plugin_piwik']['actif'].": </td>";
      echo "<td>";
      Dropdown::showYesNo("actif",$this->fields["actif"]);
      echo "</td></tr>";

      echo "<tr><th colspan='2'><input type='hidden' name='id' value='1'><input type=\"submit\" name=\"update_config\" class=\"submit\" value=\"".$LANG["buttons"][2]."\" ></th></tr>";
      echo "</table></div>";
      echo "</form><br>";
	}
}

?>