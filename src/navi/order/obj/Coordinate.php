<?php
declare(strict_types=1);

namespace navi\order\obj;

use pocketmine\math\Vector2;

class Coordinate extends Vector2{
	protected string $name;
	protected ?float $send_distance;

	public function __construct(float $x, float $y, string $name, ?float $distance = null){
		parent::__construct($x, $y);
		$this->name = $name;
		$this->send_distance = $distance;
	}

	public function getName():string{
		return $this->name;
	}

	public function getSendDistance():?float{
		return $this->send_distance;
	}
}