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
 
/*
 * Fonction obligatoire qui retourne les informations de version du plugin:
 */
function plugin_version_piwik()
{
	return array( 	'name'    		=> "Piwik",
			'minGlpiVersion' 	=> '0.83',
			'license'        => 'GPLv2+',
			'version' 		=> '1.0.0',
			'author'		=> 'Vincent DILLENSCHNEIDER',
			'homepage'		=> ''
	);
}

/**
 * 
 * @desc Fonctio init du plugin
 */
function plugin_init_piwik()
{
	global $PLUGIN_HOOKS;
	
	$plugin = new Plugin();
	
	$PLUGIN_HOOKS['submenu_entry']['piwik']['config'] = 'front/config.form.php';
	$PLUGIN_HOOKS['config_page']['piwik'] = 'front/config.form.php';

	// Si plugin active...
	if ( $plugin->isActivated("piwik") ) {
		$config = new PluginPiwikConfig();
		$config->GetFromDB(1);
		// Si alimentation active?
		if ( $config->fields["actif"] == 1 ) {
			// Inclusion des scripts js pour alimentation piwik
			$PLUGIN_HOOKS['add_javascript']['piwik'][]="js/jquery-1.8.3.min.js";
			$PLUGIN_HOOKS['add_javascript']['piwik'][]="js/piwik_js.php";
		}
	}

	Plugin::registerClass('PluginPiwik');

}
/**
 * 
 * @desc Vérifie les pré-requis du plug-in
 */
function plugin_piwik_check_prerequisites()
{
	if (GLPI_VERSION >= 0.78)
		return true;
	echo "A besoin de la version 0.78";
	return false;
}
/**
 * 
 * @desc Test si la config de GLPI permet d'utiliser le plug-in
 */
function plugin_piwik_check_config()
{
	return true;
}
/**
 * 
 * @desc Permet de créer la table BDD utile au plug-in
 */
function plugin_piwik_install()
{
	global $DB;
	$query = "CREATE TABLE `glpi_plugin_piwik` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`id_site` INT(11) NOT NULL,
	`url` VARCHAR(150) NOT NULL,
	`actif` TINYINT(1) NOT NULL DEFAULT 1
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	";
	$DB->query($query) or die($DB->error());

	$query = "INSERT INTO glpi_plugin_piwik VALUES (1,0,'http://urlverspiwik.domaine/piwik/',0)";
	$DB->query($query) or die($DB->error());	
	
	return true; // ne pas oublier !!!
}
/**
 * 
 * @desc Permet de détruire la table BDD utile au plug-in
 */
function plugin_piwik_uninstall()
{
	global $DB;
	$query = "DROP TABLE `glpi_plugin_piwik`;";
	$DB->query($query) or die($DB->error());
	
	
	return true; // ne pas oublier !!!
}
