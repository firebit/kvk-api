<?php
namespace Firebit\kvkAPI\Items;


class SearchItem extends BaseItem
{
    public $kvk_number;
    public $branch_number;

    public $business_name;
    public $current_trade_names = [];

    public $has_entry_in_business_register;
    public $has_non_mailing_indication;
    public $is_legal_person;

    public $is_branch;
    public $is_main_branch;

    public $addresses = [];

    function __construct($item)
    {
        $this->kvk_number = $item['kvkNumber'];

        // These might not be set
        if(isset($item['branchNumber'])){
            $this->branch_number = $item['branchNumber'];
        }

        if(isset($item['tradeNames']['businessName'])){
            $this->business_name = $item['tradeNames']['businessName'];
        }

        if(isset($item['tradeNames']['currentTradeNames'])){
            $this->current_trade_names = $item['tradeNames']['currentTradeNames'];
        }

        $this->has_entry_in_business_register = $item['hasEntryInBusinessRegister'];
        $this->has_non_mailing_indication = $item['hasNonMailingIndication'];
        $this->is_legal_person = $item['isLegalPerson'];
        $this->is_branch = $item['isBranch'];
        $this->is_main_branch = $item['isMainBranch'];
        $this->addresses = $item['addresses'];
    }

    public function numberOfTradeNames()
    {
        return count($this->current_trade_names);
    }

}