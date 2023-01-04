<?php

namespace Biswajit;

use onebone\economyapi\EconomyAPI;

use jojoe77777\FormAPI\SimpleForm;

use jojoe77777\FormAPI\CustomForm;

use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;

use pocketmine\scheduler\ClosureTask;

use pocketmine\Server;

use pocketmine\math\Vector3;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class Warps extends PluginBase implements Listener {

  

  public function onEnable() : void {

    

        $this->getLogger()->info("FastTravelUI By Biswajit Is Now Enabled ✅");

        

  }

  

  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

        switch($command->getName()){

            case "travel":

              if($sender->hasPermission("travel.cmd")){

                $this->travel($sender);

              } else {

                $sender->sendMessage("You Don't Have Permission To Use This Command");

              }

        }

        return true;

  }

  

  public function travel(Player $player) {

    $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){

      if($data === null){

				return true;			}

      switch($data){

        case 0:

            $this->getServer()->dispatchCommand($player, "hub");

            break;

            

            case 1:

            $this->getServer()->dispatchCommand($player, "farm");

            $player->sendTitle("§l§eFARM", "§3Welcome To Farm");

            $player->sendMessage("§aTeleported You To §bFarm");

            break;

            

            case 2:

            $this->getServer()->dispatchCommand($player, "coalmine");

            $player->sendTitle("§l§6MINE", "§3Welcome To Mine");

            $player->sendMessage("§aTeleported You To §bMine");

            break;

            

            case 3:

            $this->getServer()->dispatchCommand($player, "woodland");

            $player->sendTitle("§l§aWOODLAND", "§3Welcome To WoodLand");

            $player->sendMessage("§aTeleported You To §bWoodLand");

            break;

            

            case 4:

            $this->getServer()->dispatchCommand($player, "graveyard");

            $player->sendTitle("§l§7GRAVEYARD", "§3Welcome To Graveyard");

            $player->sendMessage("§aTeleported You To §bGraveyard");

            break;

            

            case 5:

            $this->getServer()->dispatchCommand($player, "desert");

            $player->sendTitle("§l§fDESERT", "§3Welcome To Desert");

            $player->sendMessage("§aTeleported You To §bDesert");

            break;

            

            case 6:

            $this->getServer()->dispatchCommand($player, "spiderden");

            $player->sendTitle("§l§9SPIDER'S DEN", "§3Welcome To Spider's Den");

            $player->sendMessage("§aTeleported You To §bSpider's Den");

            break;

            

            case 7:

            $this->getServer()->dispatchCommand($player, "nether");

            $player->sendTitle("§l§cNETHER", "§3Welcome To Nether");

            $player->sendMessage("§aTeleported You To §bNether");

            break;

            

            case 8:

            $this->getServer()->dispatchCommand($player, "end");

            $player->sendTitle("§l§dEND", "§3Welcome To End");

            $player->sendMessage("§aTeleported You To §bEnd");

            break;

            

            case 9:

            $this->getServer()->dispatchCommand($player, "pvp");

            $player->sendTitle("§l§2PVP ARENA", "§3Welcome To PvP Arena");

            $player->sendMessage("§aTeleported You To §bPvP Arena");

            break;

      }

    });

    $form->setTitle("§l§cFAST TRAVEL");

    $form->setContent("§r§9Select The Place Which You Want To Teleport:");

    $form->addButton("§l§bHUB\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/2451/2451728.png");

    $form->addButton("§l§bFARM\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/4062/4062297.png");

    $form->addButton("§l§bMINE\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/1504/1504044.png");

    $form->addButton("§l§bWOODLAND\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/2321/2321588.png");

    $form->addButton("§l§bGRAVEYARD\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/3504/3504590.png");

    $form->addButton("§l§bDESERT\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/740/740803.png");

    $form->addButton("§l§bSPIDER'S DEN\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/2959/2959301.png");

    $form->addButton("§l§bNETHER\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/2206/2206644.png");

    $form->addButton("§l§bEND\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/52/52349.png");

    $form->addButton("§l§bPVP ARENA\n§r§l§d» §r§8Tap To Teleport", 1, "https://cdn-icons-png.flaticon.com/512/861/861908.png");

    $form->sendtoPlayer($player);

    return $form;

  }

}
