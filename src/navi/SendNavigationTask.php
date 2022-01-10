<?php
declare(strict_types=1);

namespace navi;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class SendNavigationTask extends Task{
	public function onRun():void{
		
	}

	protected function send(Player $player, NavigationOrder $order):void{
		$player->sendJukeboxPopup($order->getTxt(), []);
	}
}