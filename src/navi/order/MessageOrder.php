<?php
declare(strict_types=1);

namespace navi\order;

use pocketmine\player\Player;

class MessageOrder extends NavigationOrder{
	protected string $txt;
	
	public function __construct(string $txt, int $lifetime, int $layer = 2){
		parent::__construct($lifetime, $layer);
		$this->txt = $txt;
	}

	public function getTxt(Player $player):string{
		return $this->txt;
	}
}