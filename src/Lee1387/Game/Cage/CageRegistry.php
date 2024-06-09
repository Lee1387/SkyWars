<?php

declare(strict_types=1);

namespace Lee1387\Game\Cage;

use pocketmine\utils\CloningRegistryTrait;
use Lee1387\Game\Cage\Presets\Angel;
use Lee1387\Game\Cage\Presets\Banana;
use Lee1387\Game\Cage\Presets\Blue;
use Lee1387\Game\Cage\Presets\Bubblegum;
use Lee1387\Game\Cage\Presets\Cloud;
use Lee1387\Game\Cage\Presets\Dark;
use Lee1387\Game\Cage\Presets\DefaultCage;
use Lee1387\Game\Cage\Presets\Green;
use Lee1387\Game\Cage\Presets\Ice;
use Lee1387\Game\Cage\Presets\Lime;
use Lee1387\Game\Cage\Presets\MagicBox;
use Lee1387\Game\Cage\Presets\Mist;
use Lee1387\Game\Cage\Presets\Nicolas;
use Lee1387\Game\Cage\Presets\Orange;
use Lee1387\Game\Cage\Presets\Premium;
use Lee1387\Game\Cage\Presets\Privacy;
use Lee1387\Game\Cage\Presets\Rage;
use Lee1387\Game\Cage\Presets\Royal;
use Lee1387\Game\Cage\Presets\Sky;
use Lee1387\Game\Cage\Presets\Slime;
use Lee1387\Game\Cage\Presets\Toffee;
use Lee1387\Game\Cage\Presets\Tree;
use Lee1387\Game\Cage\Presets\VoidCage;

/**
 * @method static Angel ANGEL()
 * @method static Banana BANANA()
 * @method static Blue BLUE()
 * @method static Bubblegum BUBBLEGUM()
 * @method static Cloud CLOUD()
 * @method static Dark DARK()
 * @method static DefaultCage DEFAULT()
 * @method static Green GREEN()
 * @method static Ice ICE()
 * @method static Lime LIME()
 * @method static MagicBox MAGIC_BOX()
 * @method static Mist MIST()
 * @method static Nicolas NICOLAS()
 * @method static Orange ORANGE()
 * @method static Premium PREMIUM()
 * @method static Privacy PRIVACY()
 * @method static Rage RAGE()
 * @method static Royal ROYAL()
 * @method static Sky SKY()
 * @method static Slime SLIME()
 * @method static Toffee TOFFEE()
 * @method static Tree TREE()
 * @method static VoidCage VOID()
 */

class CageRegistry 
{

    use CloningRegistryTrait;

    /**
     * @return Cage[]
     */
    static public function getAll(): array 
    {
        return self::_registryGetAll();
    }

    static protected function setup(): void 
    {
        self::register("angel", new Angel());
        self::register("banana", new Banana());
        self::register("blue", new Blue());
        self::register("bubblegum", new Bubblegum());
        self::register("cloud", new Cloud());
        self::register("dark", new Dark());
        self::register("default", new DefaultCage());
        self::register("green", new Green());
        self::register("ice", new Ice());
        self::register("lime", new Lime());
        self::register("magic_box", new MagicBox());
        self::register("mist", new Mist());
        self::register("nicolas", new Nicolas());
        self::register("orange", new Orange());
        self::register("premium", new Premium());
        self::register("privacy", new Privacy());
        self::register("rage", new Rage());
        self::register("royal", new Royal());
        self::register("sky", new Sky());
        self::register("slime", new Slime());
        self::register("toffee", new Toffee());
        self::register("tree", new Tree());
        self::register("void", new VoidCage());
    }
}