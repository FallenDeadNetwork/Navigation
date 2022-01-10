<?php
declare(strict_types=1);

namespace navi\order;

use navi\order\obj\Coordinate;
use pocketmine\math\Vector2;
use pocketmine\player\Player;
use pocketmine\world\Position;

class CoordinatesOrder extends NavigationOrder{
	/** @var Coordinate[] */
	protected array $coordinates;
	protected string $else_slot;

	public function __construct(int $lifetime, int $layer, string $else_slot, Coordinate ...$coordinates){
		parent::__construct($lifetime, $layer);
		$this->coordinates = $coordinates;
		$this->else_slot = $else_slot;
	}

	public function getTxt(Player $player):string{
		$render_slots = [
			0 => $this->else_slot,
			1 => $this->else_slot,
			2 => $this->else_slot,
			3 => $this->else_slot,
			4 => $this->else_slot,
			5 => $this->else_slot,
			6 => $this->else_slot,
			7 => $this->else_slot,
			8 => $this->else_slot
		];
		$yaw = $player->getLocation()->getYaw();
		$v1 = $this->toVector2($player->getPosition());
		
		foreach($this->coordinates as $v2){
			$distance =  $v2->getSendDistance();

			if($distance !== null and $v1->distance($v2) > $distance) continue;
			$delta_x = $v2->x - $v1->x;
			$azimuth = atan2($delta_x, cos($v1->y) * tan($v2->y) - sin($v1->y) * cos($delta_x)) - $yaw;

			if($azimuth > 360) $azimuth -= 360;
			if($azimuth > 180) continue;
			$render_slots[(int) round($azimuth/20)] = $v2->getName();
		}
		return implode(''. $render_slots);
	}

	protected function toVector2(Position $pos):Vector2{
		return new Vector2($pos->x, $pos->y);
	}
}