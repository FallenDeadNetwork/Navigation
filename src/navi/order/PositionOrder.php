<?php
declare(strict_types=1);

namespace navi\order;

use pocketmine\player\Player;

class PositionOrder extends NavigationOrder{
	
	public function __construct(int $lifetime, int $layer){
		
		parent::__construct($lifetime, $layer);

	}

	public function getTxt(Player $player):string{
		
	}
}