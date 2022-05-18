<?php

namespace models;

class Article
{
    public function __construct(
        $agency_id,
        $title,
        $sentenses,
        $eyecatch
    )
    {
        $this->agency_id = $agency_id;
        $this->title = $title;
        $this->sentenses = $sentenses;
        $this->eyecatch = $eyecatch;
    }
}
