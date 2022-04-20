<?php

namespace Craft\Cruds;

class User
{
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAgenciesByNew()
    {
        // TODO
        $stmt = $this->db->prepare('SELECT
        agency.name,
        article.title,
        article.sentenses,
        article.eyecatch_url
        FROM agencies as agency
        LEFT JOIN agency_articles as article
        ON agency.id = article.agency_id
        ORDER BY article.updated_at DESC');
        $stmt->execute();
        $values = $stmt->fetchAll();

        return json_encode($values);
    }
}
