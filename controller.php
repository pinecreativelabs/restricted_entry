<?php           
namespace Concrete\Package\RestrictedEntry;
use Package;
use Database;
use BlockType;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package {

	protected $pkgHandle = 'restricted_entry';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '0.9.8';
	
	
	public function getPackageDescription() {
		return t("Request visitor age verification before viewing page content.");
	}

	public function getPackageName() {
		return t("Restricted Entry");
	}
	
	public function install()
	{
		$pkg = parent::install();
        BlockType::installBlockType('restricted_entry', $pkg);
	}
	
	public function uninstall() 
    {
        parent::uninstall();
        $db = Database::connection();
        $db->ExecuteQuery('DROP TABLE IF EXISTS btRestrictedEntry');
    }
}
?>