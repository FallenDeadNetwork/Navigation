<?php
declare(strict_types=1);

namespace navi;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class SendNavigationTask extends Task{
	public function onRun():void{
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			$order = NavigationPool::getInstance()->getOrder($player);

			if($order === null) return;
			$this->send($player, $order);
		}
	}

	protected function send(Player $player, NavigationOrder $order):void{
		$player->sendJukeboxPopup($order->getTxt(), []);
	}
}