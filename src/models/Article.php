<?php

namespace models;

class Article
{
    public function __construct(
        $agency_id,
        $title,
        $sentenses,
        $eyecatch_url
    )
    {
        $this->agency_id = $agency_id;
        $this->title = $title;
        $this->sentenses = $sentenses;
        $this->eyecatch_url = $eyecatch_url;
    }
}
