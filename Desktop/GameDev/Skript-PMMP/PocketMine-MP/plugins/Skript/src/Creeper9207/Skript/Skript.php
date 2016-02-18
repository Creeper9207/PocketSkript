<?php

// This build is a pastebin preview made so people can see how it will work
// <!> THIS BUILD IS NOT A PRE-RELEASE AND ONLY PARSES EVENTS <!>
// Nothing you see here is final
// Code Is Unclean



namespace Creeper9207\Skript;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandMap;
use pocketmine\command\PluginCommand;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerBedEnterEvent;
use pocketmine\event\player\PlayerBedLeaveEvent;
use pocketmine\event\player\PlayerBucketEmptyEvent;
use pocketmine\event\player\PlayerBucketFillEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerAchievementAwardedEvent;
use pocketmine\event\player\PlayerAnimationEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\event\block\LeavesDecayEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\entity\EntityBlockChangeEvent;
use pocketmine\event\entity\EntityCombustEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityDespawnEvent;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\entity\EntityInventoryChangeEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\entity\EntityMotionEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\entity\ExplosionPrimeEvent;
use pocketmine\event\entity\ItemDespawnEvent;
use pocketmine\event\entity\ItemSpawnEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\level\ChunkLoadEvent;
use pocketmine\event\level\ChunkPopulateEvent;
use pocketmine\event\level\ChunkUnloadEvent;
use pocketmine\event\level\LevelInitEvent;
use pocketmine\event\level\LevelLoadEvent;
use pocketmine\event\level\LevelSaveEvent;
use pocketmine\event\level\LevelUnloadEvent;
use pocketmine\event\level\SpawnChangeEvent;
use pocketmine\event\plugin\PluginDisableEvent;
use pocketmine\event\plugin\PluginEnableEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\event\server\RemoteServerCommandEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\inventory\FurnaceBurnEvent;
use pocketmine\event\inventory\FurnaceSmeltEvent;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\inventory\InventoryOpenEvent;
use pocketmine\event\inventory\InventoryPickupArrowEvent;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\player;

class Skript extends PluginBase implements Listener {
    
    //0=required
    //1=optional
    
    public $EffectsMaybe = array(
        
        0  => array(
            array(
                'ban % by reason of %',
                'ban % because %', 
                'ban % because of %', 
                'ban % on account of %', 
                'ban % due to %', 
                'ban %'
            ), 
            array(
                'unban % by ip',
                'ip-unban %',
                'un-ip-ban %',
                'un ip ban %',
                'ip unban'
            ), 
            array(
                'ban % by ip reason of %',
                'ban % by ip because %', 
                'ban % by ip because of %', 
                'ban % by ip on account of %', 
                'ban % by ip due to %', 
                'ban % by ip',
                'ip-ban % by reason of %',
                'ip-ban % because %', 
                'ip-ban % because of %', 
                'ip-ban % on account of %', 
                'ip-ban % due to %', 
                'ip-ban %',
                'ip ban % by reason of %',
                'ip ban % because %', 
                'ip ban % because of %', 
                'ip ban % on account of %', 
                'ip ban % due to %', 
                'ip ban %'
            ),
            array(
                'unban %'
            )
        ),
        1  => array(
            array(
                'broadcast %',
                'broadcast % in %',
                'broadcast % to %'
            )
        ),
        2  => array(
            array(
                'cancel event',
                'cancel the event'
            ),
            array(
                'uncancel event',
                'uncancel the event'
            )
        ),
        3  => array(
            array(
                'add % to %',
                'give % to %'
            ),
            array(
                'increase % by %'
            ),
            array(
              'give % %'  
            ),
            array(
              'set % to %'
            ),
            array(
                'remove all % from %',
                'remove every % from %'
            ),
            array(
                'remove % from %',
                'subtract % from %'
            ),
            array(
                'reduce % by %'
            ),
            array(
                'delete %',
                'clear %'
            ),
            array(
                'reset %'
            )
            
        ),
        4  => array(
            array(
                'dye % %',
                'color % %',
                'colour % %',
                'paint % %'
            ),
            array(
                'dye % % % %',
                'paint % % % %',
                'color % % % %',
                'colour % % % %',
            )
        ),
        5  => array(
            array(
                'execute the command % by %',
                'execute command % by %',
                'execute the command %',
                'execute command %',
                'command %',
                'command % by %',
                '% command %',
                'execute the % command %',
                'execute % command %',
                'make % execute the command %',
                'make % execute command %',
                'make % execute %',
            )
        ),
        6  => array(
            array(
                'damage % by % hearts',
                'damage % by % heart',
                'damage % by %'
            ),
            array(
                'heal %',
                'heal % by %',
                'heal % by % heart',
                'heal % by % hearts'
            ),
            array(
                'repair %',
                'repair % by %'
            )
        ),
        7  => array(
            array(
                'wait for % %',
                'wait for %',
                'wait % %',
                'wait %',
                'halt for % %',
                'halt for %',
                'half % %',
                'halt %'
            )
        ),
        8  => array(
            array(
                'drop %',
                'drop % %'
            )
        ),
        9  => array(
            array(
                'enchant % with %',
            ),
            array(
                'disenchant %',
            )
        ),
        10 => array(
            array(
                'equip % with %',
                'equip with %',
                'make % wear %'
            ),
        ),
        11 => array(
            array(
                'exit',
                'stop',
                'exit trigger',
                'stop trigger'
            )
        ),
        12 => array(
            array(
                'create an explosion of force %',
                'create an explosion of force % %'
            )
        ),
        13 => array(),
        14 => array(),
        15 => array(),
        16 => array(),
        17 => array(),
        18 => array(),
        19 => array(),
        20 => array(),
        21 => array(),
        22 => array(),
        23 => array(),
        24 => array(),
        25 => array(),
        26 => array(),
        27 => array(),
        28 => array(),
        29 => array(),
        30 => array(),
        31 => array(),
    );
    
    public $Effects = array(
        
        0  => array(
            'ban %texts/offline players% [(by reason of|because [of]|on account of|due to) %text%]',
            'unban %texts/offline players%',
            'ban %players% by IP [(by reason of|because [of]|on account of|due to) %text%]',
            'unban %players% by IP',
            'IP(-| )ban %players% [(by reason of|because [of]|on account of|due to) %text%]',
            '(IP(-| )unban|un[-]IP[-]ban) %players%',
        ),
        1  => array(
            'broadcast %texts% [(to|in) %worlds%]',
        ),
        2  => array(
            'cancel [the] event',
            'uncancel [the] event'
        ),
        3  => array(
            '(add|give) %objects% to %~objects%',
            'increase %~objects% by %objects%',
            'give %~objects% %objects%',
            'set %~objects% to %objects%',
            'remove (all|every) %objects% from %~objects%',
            '(remove|subtract) %objects% from %~objects%',
            'reduce %~objects% by %objects%',
            '(delete|clear) %~objects%',
            'reset %~objects%'
        ),
        4  => array(
           '(dye|colo[u]r|paint) %slots/item stack% %color%',
           '(dye|colo[u]r|paint) %slots/item stack% (%number%, %number%, %number%)'
        ),
        5  => array(
            '[execute] [the] command %texts% [by %players/console%]',
            '[execute] [the] %players/console% command %texts%',
            '(let|make) %players/console% execute [[the] command] %texts%'
        ),
        6  => array(
            'damage %slots/living entities/item stack% by %number% [heart[s]]',
            'heal %living entities% [by %number% [heart[s]]]',
            'repair %slots/item stack% [by %number%]'
        ),
        7  => array(
            '(wait|halt) [for] %time span%',
        ),
        8  => array(
           'drop %item types/experience point% [%directions% %locations%]',
        ),
        9  => array(
            'enchant %~item stack% with %enchantment types%',
            'disenchant %~item stack%',
        ),
        10 => array(
            'equip [%living entity%] with %item types%',
            'make %living entity% wear %item types%'
        ),
        11 => array(
            '(exit|stop) [trigger]'
        ),
        12 => array(
           '[(create|make)] [an] explosion (of|with) (force|strength|power) %number% [%directions% %locations%]',
           '[(create|make)] [a] safe explosion (of|with) (force|strength|power) %number% [%directions% %locations%]',
           '[(create|make)] [a] fake explosion [%directions% %locations%]',
           '[(create|make)] [an] explosion[ ]effect [%directions% %locations%]',
        ),
        13 => array(
            '(ignite|set fire to) %entities% [for %time span%]',
            '(set|light) %entities% on fire [for %time span%]',
            'extinguish %entities%',
        ),
        14 => array(
            'kick %players% [(by reason of|because [of]|on account of|due to) %text%]'
        ),
        15 => array(
            'kill %entities%'
        ),
        16 => array(
            'strike [lightning ]%directions% %locations%'
        ),
        17 => array(
            'log %texts% [(to|in) [file[s]] %texts%]'
        ),
        18 => array(
            '(message|send [message]) %texts% [to %players/console%]'
        ),
        19 => array(
            'de(-| )op %offline players%',
            'op %offline players%'
        ),
        20 => array(
            '[(open|show) ((crafting [table]|workbench) (view|window|inventory)]|%inventory%) (to|for) %players%',
            'close [the] inventory [view] (to|of|for) %players%',
            "close %players%'[s] inventory [view]"
        ),
        21 => array(
            '(play|show) %visual effects% (on|%directions%) %entities/locations% [to %players%]'
        ),
        22 => array(
            'poison %living entities% [for %time span%]',
            '(cure|unpoison) %living entities% [(from|of) poison]'
        ),
        23 => array(
            'apply [potion of] %potions% [potion] [[[of] tier] %number%] to %living entities% [for %time span%]'
        ),
        24 => array(
            '(push|thrust) %entities% %direction% [(at|with) (speed|velocity|force) %number%]'
        ),
        25 => array(
            'enable PvP [in %worlds%]',
            'disable PVP [in %worlds%]'
        ),
        26 => array(
            'replace [(all|every)] %texts% in %text% with %text%',
            'replace [(all|every)] %texts% with %text% in %text%'
        ),
        27 => array(
            'shear %living entities%',
            'un[-]shear %living entities%'
        ),
        28 => array(
            'shoot %entity types% [from %living entities/locations%] [(at|with) (speed|velocity) %number%] [%direction%]',
            '(make|let) %living entities/locations% shoot %entity types% [(at|with) (speed|velocity) %number%] [%direction%]'
        ),
        29 => array(
            'spawn %entity types% [%directions% %locations%]',
            'spawn %number% of %entity types% [%directions% %locations%]'
        ),
        30 => array(
            'teleport %entities% (to|%direction%) %location%'
        ),
        31 => array(
            '(close|turn off|de[-]activate) %blocks%',
            '(toggle|switch) [[the] state of] %blocks%',
            '(open|turn on|activate) %blocks%'
        ),
        32 => array(
            '(grow|create|generate) tree [of type %tree type%] %directions% %locations%',
            '(grow|create|generate) %tree type% [tree] %directions% %locations%'
        ),
        33 => array(
            '(make|let|force) %entities% [to] (ride|mount) [(in|on)] %entity/entity types%',
            '[(make|let|force) %entities% [to] (dismount|(dismount|leave) (from|of)] [(any|the[ir]|his|her)] vehicle[s])',
            '[(eject|dismount) (any|the)] passenger[s] (of|from) %entities%'
        ),
    );
    
    public $Events = array(
       
            0 => array("on bed enter"),
            1 => array("on bed leave"),
            2 => array("on bucket empty"),
            3 => array("on bucket fill"),
            4 => array("on chat"),
            5 => array("on command"),
            6 => array("on death"),
            7 => array("on drop"),
            8 => array("on change game mode", "on game mode change", "on change of game mode", "on change gamemode", "on gamemode change", "on change of gamemode"),
            9 => array("on tap", "on left click", "on right click", "on interact"),
            10=> array("on consume", "on eat", "on item consume"),
            11=> array("on item hold", "on hold"),
            12=> array("on join", "on player join"),
            13=> array("on kick", "on player kick"),
            14=> array("on login", "on player login"),
            15=> array("on move"),
            16=> array("on pre login", "on pre-login", "on prelogin"),
            17=> array("on quit", "on player quit", "on leave", "on player leave"),
            18=> array("on respawn"),
            19=> array("on animation", "on player animation"),
            20=> array("on achievement", "on achieve", "on player achieve", "on player achievement"),
            21=> array("on break", "on break of block", "on block break"),
            22=> array("on form", "on block form", "on form of block"),
            23=> array("on block grow", "on grow of block"),
            24=> array("on place", "on place of block", "on block place"),
            25=> array("on spread", "on block spread", "on spread of block"),
            26=> array("on update", "on block update", "on update of block"),
            27=> array("on decay", "on decay of leaves", "on leaves decay"),
            28=> array("on sign change", "on change of sign"),
            29=> array("on change of armor", "on armor change", "on change of armour", "on armour change"),
            30=> array("on block change", "on change of block"),
            31=> array("on combust", "on entity combust", "on creeper combust", "on new vine trend"),
            32=> array("on damage", "on entity damage"),
            33=> array("on entity death", "on death of entity"),
            34=> array("on despawn", "on entity despawn", "on despawn of entity"),
            35=> array("on explode", "on vine reference", "on creeper explode", "on entity explode"),
            36=> array("on inventory change"),
            37=> array("on level change", "on world change"),
            38=> array("on motion"),
            39=> array("on regain health", "on regenerate"),
            40=> array("on shoot of bow", "on bow shoot", "on shoot", "on noscope"),
            41=> array("on spawn of entity", "on entity spawn"),
            42=> array("on teleport"),
            43=> array("on prime", "on entity prime", "on prime of entity"),
            44=> array("on item despawn", "on despawn of item"),
            45=> array("on item spawn", "on spawn of item"),
            46=> array("on projectile hit", "on impact"),
            47=> array("on projectile shoot", "on projectile launch"),
            48=> array("on craft item", "on craft", "on item craft", "on craft of item"),
            49=> array("on furnace burn", "on smelt start"),
            50=> array("on smelt", "on furnace smelt", "on smelt end"),
            51=> array("on inventory close", "on close of inventory"),
            52=> array("on inventory open", "on open of inventory"),
            53=> array("on arrow pickup", "on pick up of arrow", "on arrow collect"),
            54=> array("on item pickup", "on pick up of item", "on item collect"),
            55=> array("on transaction", "on move item", "on item transaction"),
            56=> array("on enable"),
            57=> array("on disable"),
            58=> array("on chunk load", "on load of chunk"),
            59=> array("on chunk populate", "on populate of chunk"),
            60=> array("on chunk unload", "on unload of chunk"),
            61=> array("on level initialize", "on initialize of level"),
            62=> array("on level load", "on load of level"),
            63=> array("on level save", "on save of level"),
            64=> array("on level unload", "on unload of level"),
            65=> array("on spawn change", "on change of spawn"),
            66=> array("on packet receive", "on receive of packet"),
            67=> array("on packet send", "on packet receive"),
            68=> array("on query regenerate", "on regenerate of query"),
            69=> array("on remote server command", "on rcon command"),
            70=> array("on server command", "on console command"),
        );
    
    public function onLoad() {

        $command = new PluginCommand("skript", $this);
        $command->setUsage("Skript reload [all]");
        $command->setDescription("Central Skript Command");
        $command->setPermission("Skript.admin");
        $command->setPermissionMessage("PocketSkript EXPEREMENTAL by Creeper9207");
        //$command->setExecutor($executor);
        $this->getServer()->getCommandMap()->register("Skript", $command);
    }
    
    

    public function onEnable() {
        
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->EventChunks = array();
        
        
            

        if (!file_exists('plugins/Skript')) {
            mkdir("plugins/Skript");
            mkdir("plugins/Skript/scripts");
        }
        if (!file_exists('plugins/Skript/scripts/test.sk')) {
            $myfile = fopen("plugins/Skript/scripts/test.sk", "w") or die("Unable to open file!");
            $txt = "#empty";
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        
        $Events = array();
        $Commands = array();
        $Variables = array();
        $LocalVariables = array();
        $EventIterator = 0;
        
        $Expected = 0;
        foreach (file('plugins/Skript/scripts/test.sk') as $lineKey => $line) {
            $ColonTest = substr(trim($line), -1);
            $Indentation = strspn($line, "\t");
            if ($Indentation === $Expected) {
                
            } elseif ($Indentation < $Expected) {

                $Expected = $Expected - ($Expected - $Indentation);
            } elseif ($Indentation > $Expected) {
                echo "Indent Error @ " . $lineKey . "\n";
            }




            if (strcmp($ColonTest, ":") == 0) {
                
                $Expected = $Expected + 1;
            } else {
                
            }
        }
        
        
        
        $TmpOffset=0;
        $tm = array();
        $Chunks = array();
        $Chunk = 0;
        
        $ChunkIndent = 0;
        $ChunkParents = array();
        $ChunkParent=0;
        $Chunks[$Chunk] = "";
        $mouse=0;
        
        $this->Execute = function ($ChunkExec, $constants, $event) {
            
            
            
            return $constants;
            
        };
        $this->Register = function ($plugin) {
            
            
            
        };
        
        $Expected = 0;
        foreach (file('plugins/Skript/scripts/test.sk') as $lineKey => $line) {
            
            $ColonTest = substr(trim($line), -1);
            $Indentation = strspn($line, "\t");
            
            if ($Indentation === $Expected) {
                if (strcmp($ColonTest, ":") == 0) {
                    
                } else {
                   $tLine = str_replace(' ', 'X_OBJ_SPACE', $line);
                   $tLine = str_replace('X_OBJ_SPACE', ' ', preg_replace('/\s+/', '', $tLine));
                   $Chunks[$Chunk] = $Chunks[$Chunk] . $tLine . "\n";
                
                }
            } elseif ($Indentation < $Expected) {
                
                $Chunk = $ChunkParents[$ChunkParent - ($Expected - $Indentation)];
                
                $ChunkIndent = $ChunkIndent - ($Expected - $Indentation);
                
                $Expected = $Expected - ($Expected - $Indentation);
            } elseif ($Indentation > $Expected) {
                echo "Indent Error @ " . $lineKey . "\n";
            }
            
            
            


            if (strcmp($ColonTest, ":") == 0) {
                $ChunkParents[$ChunkParent] = $Chunk;
                $ChunkParent = $ChunkParent + 1;
                $TmpOffset = 0;
                $Looping=TRUE;
                $TmpOffset=0;
                while ($Looping == TRUE) {
                    if (isset($Chunks[$TmpOffset])) {
                        $TmpOffset=$TmpOffset + 1;
                    
                    } else {
                        $Looping=FALSE;
                    }
                }
                
                $Chunks[$Chunk] = $Chunks[$Chunk] . "X_CHUNK_" . $TmpOffset . "_EXECUTE" . "\n";
                
                $Chunk = $TmpOffset;
                
                $ChunkIndent = $ChunkIndent + 1;
                $Expected = $Expected + 1;
                
                $Chunks[$Chunk] = "";
                
                $tLine = str_replace(' ', 'X_OBJ_SPACE', $line);
                $tLine = str_replace('X_OBJ_SPACE', ' ', preg_replace('/\s+/', '', $tLine));
                
                foreach ($Events as $eventKey => $eventArray) {
                    foreach($eventArray as $eventName) {
                        if (stristr($tLine, $eventName) !== FALSE) {
                            
                            $this->EventChunks[$EventIterator] = array('Chunk' => $Chunk, 'ID' => $eventKey, 'Event' => $eventName);
                            $EventIterator = $EventIterator + 1;
                            
                            
                        }   
                    }
                }
                
                $Chunks[$Chunk] = $Chunks[$Chunk] . $tLine . "\n";
            } else {
                
            }
        }
        
        foreach ($Chunks as $lineKey => $line) {
           
            
        }
        
      
    }

    
    
    public function onDisable() {
        
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        if (strtolower($command->getName()) === "skript") {
            $sender->sendMessage("Usage: Â§7/Â§6skript Â§b...");
            $sender->sendMessage(" Â§breload Â§7- Â§f Reloads the config, all scripts, everything, or a specific script");
            $sender->sendMessage(" Â§benable Â§7- Â§fEnables all scripts or a specific one");
            $sender->sendMessage(" Â§bupdate Â§7- Â§fCheck for updates, read the changelog, or download the latest version of skript");
            $sender->sendMessage(" Â§bhelp Â§7- Â§fPrints this help message. Use '/skript reload/enable/disable/update' to get more info");
            return true;
        }

        return false;
    }
    
    //0
    public function onPlayerBedEnter(PlayerBedEnterEvent $event)  {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 0) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('bed' => $event->getBed(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //1
    public function onPlayerBedLeave(PlayerBedLeaveEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 1) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('bed' => $event->getBed(), 'player' => $event->getPlayer(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //2
    public function onPlayerBucketEmpty(PlayerBucketEmptyEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 2) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('bucket' => $event->getBucket(), 'player' => $event->getPlayer(), 'block' => $event->getBlockClicked(), 'cancellable' == TRUE), $event);
                $event->setItem($ReturnedConstants['bucket']);
                
                break;
            }
        }
    }
    //3
    public function onPlayerBucketFill(PlayerBucketFillEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 3) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('bucket' => $event->getBucket(), 'player' => $event->getPlayer(), 'block' => $event->getBlockClicked(), 'cancellable' == TRUE), $event);
                $event->setItem($ReturnedConstants['bucket']);
                
                break;
            }
        }
    }
    //4
    public function onPlayerChat(PlayerChatEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 4) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'message' => $event->getMessage(), 'cancellable' => TRUE), $event);
                $event->setMessage($ReturnedConstants['message']);
                $event->setPlayer($ReturnedConstants['player']);
                
                break;
            }
        }
    }
    //5
    public function onPlayerCommandPreprocess(PlayerCommandPreprocessEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 5) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('command' => $event->getMessage(), 'player', $event->getPlayer(), 'cancellable' => TRUE), $event);
                $event->setMessage($ReturnedConstants['message']);
                $event->setPlayer($ReturnedConstants['player']);
                
                break;
            }
        }
    }
    //6
    public function onPlayerDeath(PlayerDeathEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 6) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getEntity(), 'message' => $event->getDeathMessage(), 'drops' => $event->getDrops(), 'cancellable' => FALSE), $event);
                $event->setDrops($ReturnedConstants['drops']);
                $event->setDrops($ReturnedConstants['message']);
                
                break;
            }
        }
    }
    //7
    public function onPlayerDropItem(PlayerDropItemEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 7) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('item' => $event->getItem(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //8
    public function onGameModeChange(PlayerGameModeChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 8) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('gamemode' => $event->getNewGamemode(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //9
    public function onPlayerInteract(PlayerInteractEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 9) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'block' => $event->getBlock(), 'face' => $event->getFace(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //10
    public function onPlayerItemConsume(PlayerItemConsumeEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 10) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'item' => $event->getItem(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //11
    public function onPlayerItemHeld(PlayerItemHeldEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 11) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'item' => $event->getItem(), 'slot' => $event->getSlot(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //12
    public function onPlayerJoin(PlayerJoinEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 12) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'message' => $event->getJoinMessage(), 'cancellable' => FALSE), $event);
                $event->setJoinMessage($ReturnedConstants['message']);
                
                break;
            }
        }
    }
    //13
    public function onPlayerKick(PlayerKickEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 13) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'message' => $event->getQuitMessage(), 'reason' => $event->getReason(), 'cancellable' => TRUE), $event);
                $event->setQuitMessage($ReturnedConstants['message']);
                
                break;
            }
        }
    }
    //14
    public function onPlayerLogin(PlayerLoginEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 14) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'message' => $event->getKickMessage(), 'cancellable' => TRUE), $event);
                $event->setKickMessage($ReturnedConstants['message']);
                
                break;
            }
        }
    }
    //15
    public function onPlayerMove(PlayerMoveEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 15) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('old location' => $event->getFrom(), 'new location' => $event->getTo(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //16
    public function onPlayerPreLogin(PlayerPreLoginEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 16) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'message' => $event->getKickMessage(), 'cancellable' => TRUE), $event);
                $event->setKickMessage($ReturnedConstants['message']);
                
                break;
            }
        }
    }
    //17
    public function onPlayerQuit(PlayerQuitEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 17) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'message' => $event->getQuitMessage(), 'cancellable' => FALSE), $event);
                $event->setQuitMessage($ReturnedConstants['message']);
                
                break;
            }
        }
    }
    //18
    public function onPlayerRespawn(PlayerRespawnEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 18) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'respawn location' => $event->getRespawnPosition(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //19
    public function onPlayerAnimation(PlayerAnimationEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 19) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'animation' => $event->getAnimationType(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //20
    public function onPlayerAchievementAwarded(PlayerAchievementAwardedEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 20) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('achievement' => $event->getAchievement(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }

    //block events

    //21
    public function onBlockBreak(BlockBreakEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 21) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'instabreak' => $event->getInstaBreak(), 'block' => $event->getBlock(), 'item' => $event->getItem(), 'cancellable' => TRUE), $event);
                $event->setInstaBreak($ReturnedConstants['instabreak']);
                
                break;
            }
        }
    }
    //22
    public function onBlockForm(BlockFormEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 22) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'state' => $event->getNewState(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //23
    public function onBlockGrow(BlockGrowEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 23) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'state' => $event->getNewState(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //24
    public function onBlockPlace(BlockPlaceEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 24) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'block placed against' => $event->getBlockAgainst(), 'block' => $event->getBlock(), 'item' => $event->getItem(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //25
    public function onBlockSpread(BlockSpreadEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 25) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('source' => $event->getSource(), 'block' => $event->getBlock(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //26
    public function onBlockUpdate(BlockUpdateEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 26) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //27
    public function onLeavesDecay(LeavesDecayEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 27) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //28
    public function onSignChange(SignChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {

            if ($Events['ID'] == 28) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'player' => $event->getPlayer(), 'line 1' => $event->getLine(1), 'line 2' => $event->getLine(2), 'line 3' => $event->getLine(3), 'line 4' => $event->getLine(4), 'cancellable' => TRUE), $event);
                $event->setLine(1, $ReturnedConstants['line 1']);
                $event->setLine(2, $ReturnedConstants['line 2']);
                $event->setLine(3, $ReturnedConstants['line 3']);
                $event->setLine(4, $ReturnedConstants['line 4']);
                
                break;
            }
        }
    }

    //entity events

    //29
    public function onEntityArmorChange(EntityArmorChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            if ($Events['ID'] == 29) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('slot' => $event->getSlot(), 'item' => $event->getNewItem(), 'cancellable' => TRUE), $event);
                $event->setNewItem($ReturnedConstants['item']);
                
                break;
            }
        }
    }
    //30
    public function onEntityBlockChange(EntityBlockChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 30) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'block' => $event->getBlock(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //31
    public function onEntityCombust(EntityCombustEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 31) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'duration' => $event->getDuration(), 'cancellable' => TRUE), $event);
                $event->setDuration($ReturnedConstants['duration']);
                
                break;
            }
        }
    }
    //32
    public function onEntityDamage(EntityDamageEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 32) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('cause' => $event->getCause(), 'damage' => $event->getDamage(), 'entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                $event->setDamage($ReturnedConstants['damage']);
                
                break;
            }
        }
    }
    //33
    public function onEntityDeathEvent(EntityDeathEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 33) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'drops' => $event->getDrops(), 'cancellable' => FALSE), $event);
                $event->setDrops($ReturnedConstants['drops']);
                
                break;
            }
        }
    }
    //34
    public function onEntityDespawn(EntityDespawnEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 34) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //35
    public function onEntityExplode(EntityExplodeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 35) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('position' => $event->getPosition(), 'exploded blocks' => $event->getBlockList(), 'yield' => $event->getYield(), 'entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                $event->setBlockList($ReturnedConstants['exploded blocks']);
                $event->setYield($ReturnedConstants['yield']);
                
                break;
            }
        }
    }
    //36
    public function onEntityInventoryChange(EntityInventoryChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 36) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('item' => $event->getNewItem(), 'slot' => $event->getSlot(), 'entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                $event->setNewItem($ReturnedConstants['item']);
                
                break;
            }
        }
    }
    //37
    public function onEntityLevelChange(EntityLevelChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 37) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('origin' => $event->getOrigin(), 'target' => $event->getTarget(), 'entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //38
    public function onEntityMotion(EntityMotionEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 38) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //39
    public function onEntityRegainHealth(EntityRegainHealthEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 39) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('amount' => $event->getAmount(), 'entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                $event->setAmount($ReturnedConstants['amount']);
                
                break;
            }
        }
    }
    //40
    public function onEntityShootBow(EntityShootBowEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 40) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'projectile' => $event->getProjectile(), 'item' => $event->getBow(), 'cancellable' => TRUE), $event);
                $event->setProjectile($ReturnedConstants['projectile']);
                
                break;
            }
        }
    }
    //41
    public function onEntitySpawn(EntitySpawnEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 41) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //42
    public function onEntityTeleport(EntityTeleportEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 42) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //43
    public function onExplosionPrime(ExplosionPrimeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 43) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'force' => $event->getForce(), 'cancellable' => TRUE), $event);
                $event->setForce($ReturnedConstants['force']);
                
                break;
            }
        }
    }
    //44
    public function onItemDespawn(ItemDespawnEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 44) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //45
    public function onItemSpawn(ItemSpawnEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 45) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //46
    public function onProjectileHit(ProjectileHitEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 46) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //47
    public function onProjectileLaunch(ProjectileLaunchEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 47) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('entity' => $event->getEntity(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }

    //inventory events

    //48
    public function onCraftItem(CraftItemEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 48) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('input' => $event->getInput(), 'recipe' => $event->getRecipe(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //49
    public function onFurnaceBurn(FurnaceBurnEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 49) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'fuel' => $event->getFuel(), 'burn time' => $event->getBurnTime(), 'cancellable' => TRUE), $event);
                $event->setBurnTime($ReturnedConstants['burn time']);
                
                break;
            }
        }
    }
    //50
    public function onFurnaceSmelt(FurnaceSmeltEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 50) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('block' => $event->getBlock(), 'result' => $event->getResult(), 'cancellable' => TRUE), $event);
                $event->setResult('result');
                
                break;
            }
        }
    }
    //51
    public function onInventoryClose(InventoryCloseEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 51) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'inventory' => $event->getInventory(), 'cancellable' => FALSE), $event);
                
                
                break;
            }
        }
    }
    //52
    public function onInventoryOpen(InventoryOpenEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 52) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'inventory' => $event->getInventory(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //53
    public function onInventoryPickupArrow(InventoryPickupArrowEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 53) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'inventory' => $event->getInventory(), 'cancellable' => TRUE, 'item' => $event->getArrow()), $event);
                
                break;
            }
        }
    }
    //54
    public function onInventoryPickupItem(InventoryPickupItemEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 54) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('player' => $event->getPlayer(), 'inventory' => $event->getInventory(), 'cancellable' => TRUE, 'item' => $event->getItem()), $event);
                
                break;
            }
        }
    }
    //55
    public function onInventoryTransaction(InventoryTransactionEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 55) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('transaction' => $event->getTransaction(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }

    //plugin events.. woo?

    //56
    public function onPluginDisable(PluginDisableEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 56) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('plugin' => $event->getPlugin(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //57
    public function onPluginEnable(PluginEnableEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 57) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('plugin' => $event->getPlugin(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }

    //level events

    //58
    public function onChunkLoad(ChunkLoadEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 58) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('new' => $event->isNewChunk(), 'chunk' => $event->getChunk(), 'level' => $event->getChunk(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //59
    public function onChunkPopulate(ChunkPopulateEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 59) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('chunk' => $event->getChunk(), 'level' => $event->getChunk(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //60
    public function onChunkUnload(ChunkUnloadEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 60) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('chunk' => $event->getChunk(), 'level' => $event->getChunk(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //61
    public function onLevelInit(LevelInitEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 61) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('level' => $event->getLevel(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //62
    public function onLevelLoad(LevelLoadEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 62) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('level' => $event->getLevel(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //63
    public function onLevelSave(LevelSaveEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 63) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('level' => $event->getLevel(), 'cancellable' => FALSE), $event);
                
                break;
            }
        }
    }
    //64
    public function onLevelUnload(LevelUnloadEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 64) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('level' => $event->getLevel(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //65
    public function onSpawnChange(SpawnChangeEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 65) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('level' => $event->getLevel(), 'cancellable' => FALSE, 'previous spawn' => $event->getPreviousSpawn()), $event);
                
                break;
            }
        }
    }

    //server events, i assume SOMEBODY will figure these out ;)
    //I havent even tested it, but i'm already regretting making loggers for these

    //66
    public function onDataPacketReceive(DataPacketReceiveEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 66) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('packet' => $event->getPacket(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //67
    public function onDataPacketSend(DataPacketSendEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 67) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('packet' => $event->getPacket(), 'player' => $event->getPlayer(), 'cancellable' => TRUE), $event);
                
                break;
            }
        }
    }
    //68
    public function onQueryRegenerate(QueryRegenerateEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 68) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('timeout' => $event->getTimeout(), 'server name' => $event->getServerName(), 'plugins' => $event->getPlugins(), 'player count' => $event->getPlayerCount(), 'max players' => $event->getMaxPlayerCount(), 'world' => $event->getWorld(), 'extra data' => $event->getExtraData(), 'players' => $event->getPlayerList(), 'cancellable' => FALSE), $event);
                
                $event->setServerName($ReturnedConstants['server name']);
                $event->setPlugins($ReturnedConstants['plugins']);
                $event->setPlayerCount($ReturnedConstants['player count']);
                $event->setWorld($ReturnedConstants['world']);
                $event->setPlayerList($ReturnedConstants['players']);
                $event->setTimeout($ReturnedConstants['timeout']);
                $event->setMaxPlayerCount($ReturnedConstants['max players']);
                $event->setExtraData($ReturnedConstants['extra data']);
                
                break;
            }
        }
    }
    //69
    public function onRemoteServerCommand(RemoteServerCommandEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 69) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('sender' => $event->getSender(), 'command' => $event->getCommand(), 'cancellable' => TRUE), $event);
                $event->setCommand($ReturnedConstants['command']);
                
                break;
            }
        }
    }
    //70
    public function onServerCommand(ServerCommandEvent $event) {
        foreach ($this->EventChunks as $Events) {
            
            if ($Events['ID'] == 70) {
                
                $ReturnedConstants = Execute($Events['Chunk'], array('sender' => $event->getSender(), 'command' => $event->getCommand(), 'cancellable' => TRUE), $event);
                $event->setCommand($ReturnedConstants['command']);
                
                break;
            }
        }
    }

    //end of class Skript
}
