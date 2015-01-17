<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 16/01/15
 * Time: 21:50
 */

namespace Ordemservico\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TecnicoOrdem
 * @package Ordemservico\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Tecnicoordem)
 *
 */
class TecnicoOrdem {

    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=)
     * @ORM\JoinTable(name="ordem_tecnico")
     */
}