<?php

namespace cruds;

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

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);

                $item = array(
                    'name'=> $name,
                    'title' => $title,
                    'sentenses' => $sentenses,
                    'eyecatch_url' => $eyecatch_url
                );
                array_push($values, $item);
            }
        }

        return json_encode($values,JSON_UNESCAPED_UNICODE);
    }
}
