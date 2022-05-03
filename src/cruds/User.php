<?php

namespace cruds;

class User
{
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAgencies($types = null, $industries = null)
    {
        if ($types === null && $industries === null) {
            $stmt = $this->db->prepare('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                ORDER BY article.updated_at DESC
            ');
            $stmt->execute();
        } else if ($types !== null && $industries === null) {
            // TODO
            $inclause = substr(str_repeat(',?', count($types)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                WHERE agency.id IN (
                    SELECT agency_id FROM agencies_types WHERE type_id IN (%s)
                )
                ORDER BY article.updated_at DESC
            ', $inclause));
            $stmt->execute($types);
        } else if ($types === null && $industries !== null) {
            $inclause = substr(str_repeat(',?', count($industries)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                WHERE agency.id IN (
                    SELECT agency_id FROM agencies_industries WHERE industry_id IN (%s)
                )
                ORDER BY article.updated_at DESC
            ', $inclause));
            $stmt->execute($industries);
        } else {
            $type_in_clause = substr(str_repeat(',?', count($types)), 1);
            $industry_in_clause = substr(str_repeat(',?', count($industries)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT
                agency.id,
                agency.name,
                article.title,
                article.sentenses,
                article.eyecatch_url
                FROM agencies as agency
                LEFT JOIN agency_articles as article
                ON agency.id = article.agency_id
                WHERE agency.id IN (
                    SELECT agency_id FROM agencies_types WHERE type_id IN (%s)
                )
                AND agency.id IN (
                    SELECT agency_id FROM agencies_industries WHERE industry_id IN (%s)
                )
                ORDER BY article.updated_at DESC
            ', $type_in_clause, $industry_in_clause));
            $stmt->execute(array_merge($types, $industries));
        }

        $num = $stmt->rowCount();

        if ($num > 0) {
            $values = array();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $typestmt = $this->db->prepare('SELECT type.agency_type FROM agency_type as type WHERE type.id IN (
                    SELECT type_id FROM agencies_types WHERE agency_id=:agency_id
                    )
                ');
                $typestmt->bindValue(':agency_id', $id, \PDO::PARAM_INT);
                $typestmt->execute();

                $types = $typestmt->fetchAll(\PDO::FETCH_ASSOC);

                $industry_stmt = $this->db->prepare('SELECT industry FROM industries WHERE id IN (
                    SELECT industry_id FROM agencies_industries WHERE agency_id=:agency_id
                    )
                ');
                $industry_stmt->bindValue(':agency_id', $id, \PDO::PARAM_INT);
                $industry_stmt->execute();

                $industries = $industry_stmt->fetchAll(\PDO::FETCH_ASSOC);

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
            return json_encode($values, JSON_UNESCAPED_UNICODE);
        }
        return json_encode(array());
    }

    public function getAgency($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM agencies WHERE id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $agency = $stmt->fetch(\PDO::FETCH_ASSOC);
        extract($agency);
        $result = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'email_for_notification' => $email_for_notification,
            'tel' => $tel,
            'url' => $url,
            'representative' => $representative,
            'contactor' => $contactor,
            'address' => $address,
            'address_num' => $address_num,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        );
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function getType()
    {
        $stmt = $this->db->prepare('SELECT id, agency_type FROM agency_type LIMIT 20
        ');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getIndustries()
    {
        $stmt = $this->db->prepare('SELECT id, industry FROM industries LIMIT 20
        ');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


}
