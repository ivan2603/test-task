<?php

class Vehicle
{
    /**
     * Create vehicle type method
     * @param $type
     * @return string
     */
    public function create($type): string {
        $message = '';
        $db = Db::getConnection();
        $sql = 'INSERT INTO vehicles (vehicle_type) VALUES (?)';
        $result = $db->prepare($sql);
        try {
            $result->execute([$type]);
        } catch (PDOException $exception) {
            $message = "Error : " . $exception->getMessage();
        }
        return $message;
    }

    /**
     * List vehicle type method
     * @return array
     */
    public function list(): array {
        $db = Db::getConnection();
        $sql = "SELECT * FROM vehicles";
        $result = $db->query($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete vehicle type method
     * @param $id
     * @return string
     */
    public function delete($id): string {
        $message = '';
        $db = Db::getConnection();
        $sql = "DELETE FROM vehicles WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $result->execute();
        } catch (PDOException $exception) {
            $message = "Error : " . $exception->getMessage();
        }
        return $message;
    }

    /**
     * Edit vehicle type method
     * @param $id
     * @param $type
     * @return string
     */
    public function edit($id, $type) {
        $result = '';
        $db = Db::getConnection();
        $sql = 'UPDATE vehicles SET vehicle_type = ? WHERE id = ?';
        $stmt = $db->prepare($sql);
        try {
            $stmt->execute([$type, $id]);
        } catch (PDOException $exception) {
            $result = $exception->getMessage();
        }
        return $result;
    }

}