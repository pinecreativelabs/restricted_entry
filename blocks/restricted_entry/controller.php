<?php     namespace Concrete\Package\RestrictedEntry\Block\RestrictedEntry;
use \Concrete\Core\Block\BlockType\BlockType,
\Concrete\Core\Block\BlockController;
use \Concrete\Core\Block\View\BlockView as BlockView;
use Core;
use Page;

defined('C5_EXECUTE') or die("Access Denied."); 
class Controller extends BlockController
{
    protected $btTable = 'btRestrictedEntry';
    protected $btInterfaceWidth = "420";
    protected $btWrapperClass = 'ccm-ui';
    protected $btInterfaceHeight = "400";

    public function getBlockTypeDescription() {
        return t("Request visitor age verification before viewing page content.");
    }
    public function getBlockTypeName() {
        return t("Restricted Entry");
    }
	
	function getExternalLink() {return $this->extLink;}
	function getInternalLinkCID() {return $this->pageID;}
	function getLinkURL() {
		if (!empty($this->extLink)) {
			$pass = \Core::make('helper/security');
			return $pass->sanitizeURL($this->extLink);
		} else if (!empty($this->pageID)) {
			$linkToC = Page::getByID($this->pageID);
			return (empty($linkToC) || $linkToC->error) ? '' : Core::make('helper/navigation')->getLinkToCollection($linkToC);
		} else {
			return '';
		}
	}
	function getExternalFailLink() {return $this->failextLink;}
	function getInternalFailLinkCID() {return $this->failpageID;}
	function getFailLinkURL() {
		if (!empty($this->failextLink)) {
			$fail = \Core::make('helper/security');
			return $fail->sanitizeURL($this->failextLink);
		} else if (!empty($this->failpageID)) {
			$linkToC = Page::getByID($this->failpageID);
			return (empty($linkToC) || $linkToC->error) ? '' : Core::make('helper/navigation')->getLinkToCollection($linkToC);
		} else {
			return '';
		}
	}
	
	public function save($args) {
		$args['checkAge'] = intval($args['checkAge']);
		switch (intval($args['linkType'])) {
			case 1:
				$args['extLink'] = '';
				break;
			case 2:
				$args['pageID'] = 0;
				break;
			default:
				$args['extLink'] = '';
				$args['pageID'] = 0;
				break;
		}
		switch (intval($args['failLinkType'])) {
			case 1:
				$args['failextLink'] = '';
				break;
			case 2:
				$args['failpageID'] = 0;
				break;
			default:
				$args['failextLink'] = '';
				$args['failpageID'] = 0;
				break;
		}
		unset($args['linkType']);
		unset($args['failLinkType']); //this doesn't get saved to the database (it's only for UI usage)
		parent::save($args);	
	}
	
	public function validate($args) {
        $e = Core::make("helper/validation/error");       
        if(empty($args['title'])){
            $e->add(t("Title cannot be empty."));
        }
		if(empty($args['copy'])){
            $e->add(t("Copy cannot be empty."));
        }
        if(!ctype_digit(trim($args['minAge']))){
            $e->add(t("Minimum Age must be numeric only."));
        }
	}

}