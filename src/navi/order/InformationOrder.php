<?php
declare(strict_types=1);

namespace navi\order;

use pocketmine\player\Player;

class InformationOrder extends NavigationOrder{
	/** @var string[] */
	protected array $txts;
	protected int $switch_time;
	protected int $txt_index = 0;
	protected int $rumtime_count = -1;
	
	public function __construct(int $switch_time, int $lifetime, int $layer, string ...$txts){
		if($switch_time < 1) throw new \InvalidArgumentException('swich time must be more then 0');
		if(count($txts) === 0) throw new \InvalidArgumentException('need to pass one or more strings as arguments');
		parent::__construct($lifetime, $layer);
		$this->switch_time = $switch_time;
		$this->txts = $txts;
	}

	public function getTxt(Player $player):string{
		++$this->rumtime_count;
		
		if($this->rumtime_count%$this->switch_time === 0){
			++$this->txt_index;
			$this->rumtime_count = -1;
		}
		if(!isset($this->txts[$this->txt_index])) $this->txt_index = array_key_first($this->txts);
		return $this->txts[$this->txt_index];
	}
}