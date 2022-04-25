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

    public function getAgency($id) {
        $stmt = $this->db->prepare('SELECT
            agency.id,
            agency.name,
            agency.email,
            agency.tel,
            agency.url,
            agency.representative,
            agency.address,
            agency.address_num,
            article.title,
            article.sentenses,
            article.eyecatch_url
            FROM agencies as agency
            LEFT JOIN agency_articles as article
            ON agency.id = article.agency_id
            WHERE agency.id = :id
        ');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $item = $stmt->fetch(\PDO::FETCH_ASSOC);

        $type_stmt = $this->db->prepare('SELECT
            agency_type
            FROM agency_type
            WHERE id IN (
                SELECT type_id FROM agencies_types WHERE agency_id = :id
            )
        ');

        $type_stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $type_stmt->execute();
        $types = $type_stmt->fetchAll(\PDO::FETCH_ASSOC);

        $industry_stmt = $this->db->prepare('SELECT
            industry
            FROM industries
            WHERE id IN (
                SELECT industry_id FROM agencies_industries WHERE agency_id = :id
            )
        ');
        $industry_stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $industry_stmt->execute();
        $industries = $industry_stmt->fetchAll(\PDO::FETCH_ASSOC);
        extract($item);
        $result = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'url' => $url,
            'representative' => $representative,
            'address' => $address,
            'address_num' => $address_num,
            'title' => $title,
            'sentenses' => $sentenses,
            'eyecatch_url' => $eyecatch_url,
            'types' => $types,
            'industries' => $industries
        );
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}
