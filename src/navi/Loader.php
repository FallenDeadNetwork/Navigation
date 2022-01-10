<?php
declare(strict_types=1);

namespace navi;

use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{
	protected function onEnable():void{
		$this->getScheduler()->scheduleRepeatingTask(new SendNavigationTask, 4);
	}
}