<?php

declare(strict_types=1);

namespace IvanCraft623\RankSystem\command\subcommands;

use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\BaseSubCommand;

use IvanCraft623\RankSystem\command\args\RankArgument;
use IvanCraft623\RankSystem\RankSystem;
use IvanCraft623\RankSystem\rank\Rank;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;

final class DeleteCommand extends BaseSubCommand {

	public function __construct(private RankSystem $plugin) {
		parent::__construct("delete", "Delete a Rank");
		$this->setPermission("ranksystem.command.delete");
	}

	protected function prepare() : void {
		$this->registerArgument(0, new RankArgument("rank"));
	}

	public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void {
		if ($args["rank"] === $this->plugin->getRankManager()->getDefault()) {
			$sender->sendMessage("§cYou cannot delete the default rank!");
		} else {
			$this->plugin->getRankManager()->delete($args["rank"]);
			$sender->sendMessage("§eYou have successfully deleted the rank §c" . $args["rank"]->getName());
		}
	}

	public function getParent() : BaseCommand {
		return $this->parent;
	}
}