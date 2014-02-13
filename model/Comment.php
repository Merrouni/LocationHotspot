<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 16:37
 */

class Comment {

    private $id;
    private $idPlace;
    private $content;

    public function __construct($idPlace, $content)
    {
        $this->idPlace = $idPlace;
        $this->content = $content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function getContent()
    {
        return $this->content;
    }
} 