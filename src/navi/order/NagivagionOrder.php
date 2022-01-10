<?php
declare(strict_types=1);

namespace navi;

abstract class NavigationOrder{
	protected int $lifetime;

	abstract public function getLayer():int;
	abstract public function getTxt():string;

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