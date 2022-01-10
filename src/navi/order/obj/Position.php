<?php
declare(strict_types=1);

namespace navi\order\obj;

use pocketmine\world\Position as PMPosition;

class Position{
	protected PMPosition $position;
	protected string $name;
	protected ?float $send_distance;

	public function __construct(PMPosition $position, string $name, ?float $distance = null){
		$this->position = $position;
		$this->name = $name;
		$this->send_distance = $distance;
	}

	public function getName():string{
		return $this->name;
	}

	public function getPosition():PMPosition{
		return $this->position;
	}

	public function getSendDistance():?float{
		return $this->send_distance;
	}
}