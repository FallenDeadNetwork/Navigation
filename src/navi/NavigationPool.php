<?php
declare(strict_types=1);

namespace navi;

use navi\order\NavigationOrder;
use navi\utils\SingletonTrait;
use pocketmine\player\Player;

abstract class NavigationPool{
	private function __construct(){/** NOOP */}
	use SingletonTrait;
	/** @var NavigationOrder[][] */
	protected static array $orders = [];

	/**
	 * 同じレイヤーに対し二つ以上のorderを同時に保持することはできません。
	 *
	 * @param Player $player
	 * @param NavigationOrder $order
	 * @return void
	 */
	public function register(Player $player, NavigationOrder $order, bool $force = false):void{
		if(isset(self::$orders[$player->getName()][$order->getLayer()]) and !$force) return;
		self::$orders[$player->getName()][$order->getLayer()] = $order;
	}

	/**
	 * この関数でorderを取得すると格納済みorderの全てのライフタイムが減少します
	 *
	 * @param Player $player
	 * @return NavigationOrder|null
	 */
	public function getOrder(Player $player):?NavigationOrder{
		if(!isset(self::$orders[$player->getName()])) return null;
		$keys = array_keys((array) self::$orders[$player->getName()]);
		$key = max(count($keys) === 0? ['empty']: $keys);
		
		if(!is_int($key) or !isset(self::$orders[$player->getName()][$key])) return null;
		$this->reduceLifeTimes();
		$order = self::$orders[$player->getName()][$key];
		return $order;
	}

	protected function reduceLifeTimes():void{
		foreach(self::$orders as $name => $orders) foreach($orders as $key => $order){
			$order->reduceLifeTime();

			if(!$order->isActive()){
				unset(self::$orders[$name][$key]);
				self::$orders = array_filter(self::$orders);
			}
		}
	}
}