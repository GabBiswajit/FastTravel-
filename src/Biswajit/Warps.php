<?php

namespace Biswajit;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\world\Position;

class Warps extends PluginBase implements Listener {

    private Config $warpConfig;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->warpConfig = new Config($this->getDataFolder() . "warps.yml", Config::YAML);

        $this->getLogger()->info("FastTravelUI By Biswajit Is Now Enabled ✅");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "travel") {
            if ($sender instanceof Player) {
                if ($sender->hasPermission("travel.cmd")) {
                    $this->travel($sender);
                } else {
                    $sender->sendMessage("You Don't Have Permission To Use This Command");
                }
            } else {
                $sender->sendMessage("This command can only be used in-game.");
            }
            return true;
        }
        return false;
    }

    public function travel(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data = null) {
            if ($data === null) {
                return;
            }
            $locations = [
                "hub",
                "farm",
                "coalmine",
                "woodland",
                "graveyard",
                "desert",
                "spiderden",
                "nether",
                "end",
                "pvp"
            ];
            if (isset($locations[$data])) {
                $this->teleportPlayerToWarp($player, $locations[$data]);
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
        $player->sendForm($form);
    }

    private function teleportPlayerToWarp(Player $player, string $warpName): void {
        $world = $this->getServer()->getWorldManager()->getWorldByName($this->warpConfig->get("$warpName.world"));
        if ($world !== null) {
            $x = $this->warpConfig->get("$warpName.x");
            $y = $this->warpConfig->get("$warpName.y");
            $z = $this->warpConfig->get("$warpName.z");
            $position = new Position($x, $y, $z, $world);
            $player->teleport($position);

            $player->sendTitle("§l§a" . strtoupper($warpName), "§3Welcome To " . ucfirst($warpName));
            $player->sendMessage("§aTeleported You To §b" . ucfirst($warpName));
        } else {
            $player->sendMessage("§cWorld not found: " . $this->warpConfig->get("$warpName.world"));
        }
    }
}
