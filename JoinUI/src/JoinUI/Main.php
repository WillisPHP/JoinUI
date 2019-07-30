<?php

namespace JoinUI;

    use pocketmine\Player;
    use jojoe77777\FormAPI;
    use pocketmine\utils\Config;
	use pocketmine\event\Listener;
	use pocketmine\command\Command;
    use pocketmine\plugin\PluginBase;
	use pocketmine\command\CommandSender;
    use pocketmine\event\player\PlayerJoinEvent;
	
class Main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§fThe plugin was written by §aWillis");
		$this->getLogger()->info("§fGood §bluck §fto you use");
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
		
	}

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$this->Help($player);
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (strtolower($command->getName()) == "info"){
			if($sender instanceof Player){
					$this->Help($sender);
					}else{
						$this->getLogger()->info('You can use this command in the console');
			}
        }
		return false;
    }
	
	public function Help(Player $sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
				case 0:
				  break;
            }
        });
        $form->setTitle($this->getConfig()->get("title"));
        $form->setContent($this->getConfig()->get("content"));
        $form->addButton("§l§a> §r§fBack §l§a<");
        $form->sendToPlayer($sender);
	}
}