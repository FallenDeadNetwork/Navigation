<?php
declare(strict_types=1);

namespace navi;

abstract class NavigationOrder{
	protected int $priority;
	protected int $life_time;
	
	abstract public function getPriority():int;
	abstract public function getLifeTime():int;
	abstract public function getTxt():string;
}