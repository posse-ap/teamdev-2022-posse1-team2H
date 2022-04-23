<?php

namespace cruds;

class User
{
    public function __construct($db)
    {
        $this->db = $db;
    }
    // TOPページの表示
    public function getAgenciesByNew()
    {
        $stmt = $this->db->prepare('SELECT
        agency.id,
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
                $typestmt = $this->db->prepare('SELECT type.agency_type FROM agency_type as type WHERE type.id IN (
                    SELECT id FROM agencies_types WHERE agency_id=:agency_id
                    )
                ');
                $typestmt->bindValue(':agency_id', $id, \PDO::PARAM_INT);
                $typestmt->execute();

                $types = $typestmt->fetchAll();

                $industry_stmt = $this->db->prepare('SELECT industry FROM industries WHERE id IN (
                    SELECT id FROM agencies_industries WHERE agency_id=:agency_id
                    )
                ');
                $industry_stmt->bindValue(':agency_id', $id, \PDO::PARAM_INT);
                $industry_stmt->execute();

                $industries = $industry_stmt->fetchAll();

                $item = array(
                    'id' => $id,
                    'name' => $name,
                    'title' => $title,
                    'sentenses' => $sentenses,
                    'eyecatch_url' => $eyecatch_url,
                    'types' => $types,
                    'industries' => $industries,
                );
                array_push($values, $item);
            }
        }

        return json_encode($values, JSON_UNESCAPED_UNICODE);
    }

    public function getType() {
        $stmt = $this->db->prepare('SELECT id, agency_type FROM agency_type LIMIT 20
        ');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getIndustries() {
        $stmt = $this->db->prepare('SELECT id, industry FROM industries LIMIT 20
        ');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
