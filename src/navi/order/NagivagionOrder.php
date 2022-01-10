<?php
declare(strict_types=1);

namespace navi\order;

use pocketmine\player\Player;

abstract class NavigationOrder{
	protected int $lifetime;
	protected int $layer;
	
	abstract public function getTxt(Player $player):string;

	public function __construct(int $lifetime, int $layer){
		$this->lifetime = $lifetime;
		$this->layer = $layer;
	}

	public function getLayer():int{
		return $this->layer;
	}

	public function getLifeTime():int{
		return $this->lifetime;
	}

	public function reduceLifeTime(int $amount = 1):void{
		$this->lifetime -= $amount;
	}

	public function isActive():bool{
		return $this->lifetime > 0;
	}
}