<?php



namespace xpperks;



use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\PluginBase;
use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;



class Main extends PluginBase implements Listener{
	

	public const PREFIX = "§6XPPerks§b>>§a";

    public function onEnable(){

        $this->getServer()->getLogger()->info("XPPerks aktiviert!");

    }

    

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		if($cmd->getName() == "xpperks"){
			$this->xpperks($sender);
		}
		return true;
	}

	

	public function xpperks($player) {
        $form = new SimpleForm(function (Player $player, int $data = null){
 

            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
            case 0:
            break;

            case 1:
            $axp = $player->getXpLevel();
			$z = $axp - 10;
			if($z >= 0) {
				$player->setXpLevel($z);
           		$effect = new EffectInstance(Effect::getEffectByName("NIGHT_VISION"));
				$effect->setAmplifier(5);
				$player->addEffect($effect);
				$player->addTitle("§6XPPerk aktiviert!", "§bDu hast jetzt Nachtischt!");
            }
            else {
            $player->sendMessage(self::PREFIX ."§4Du hast zu wenig Level.");
            }
            break;

            case 2:
            $axp = $player->getXpLevel();
			$z = $axp - 20;
			if($z >= 0) {
				$player->setXpLevel($z);
           		$effect = new EffectInstance(Effect::getEffectByName("HASTE"));
				$effect->setAmplifier(5);
				$player->addEffect($effect);
				$player->addTitle("§6XPPerk aktiviert!", "§bDu hast jetzt Eile!");

            }
            else {
            $player->sendMessage(self::PREFIX ."§4Du hast zu wenig Level.");
            }
            break;

            case 3:
            $axp = $player->getXpLevel();
			$z = $axp - 10;
			if($z >= 0) {
				$player->setXpLevel($z);
           		$effect = new EffectInstance(Effect::getEffectByName("JUMP"));
           		$effect->setAmplifier(5);
				$player->addEffect($effect);
				$player->addTitle("§6XPPerk aktiviert!", "§bDu hast jetzt Sprungkraft!");
            }
            else {
            $player->sendMessage(self::PREFIX ."§4Du hast zu wenig Level.");
            }
            break;

            

            }

 

        });

 

        $form->setTitle("§6XPPerks");
        $form->setContent("§bIhr kannst du von deinem XP Dir Perks Kaufen");
        $form->addButton("§l§4Schließen");
        $form->addButton("§l§aNachtsicht V\n §r§e 10 Level / 5 Minuten");
        $form->addButton("§l§aEile V\n §r§e 20 Level / 5 Minuten");
        $form->addButton("§l§aSprungkraft V\n §r§e 10 Level / 5 Minuten");
        $form->sendToPlayer($player);
        return $form;

			}

		}