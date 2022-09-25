<?php
class editors {
    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $schema = "eszs";
    private static $instance = null;

    private static function getInstance() {
        if (!self::$instance) {
            $config = "mysql:host=" . self::$host
                    . ";dbname=" . self::$schema;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            self::$instance = new PDO($config, self::$user, self::$password, $options);
        }

        return self::$instance;
    }

    public static function getAdminRoles() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT role_id, title FROM editors_roles");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getSpecificAdmin($admin_id) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT admin_id, ime, priimek, email, password FROM editors_admins WHERE admin_id = :admin_id");
        $statement->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getSpecificAdminRoles($id_of_admin) {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT editors_admins.admin_id as admin_primary_id, editors_admin_has_role.admin_id as admin_secondary_id, 
                                            editors_admin_has_role.role_id as role_secondary_id,editors_roles.role_id as role_primary_id, 
                                            editors_roles.title as title 
                                    FROM editors_admins
                                    INNER JOIN editors_admin_has_role
                                    ON editors_admins.admin_id=editors_admin_has_role.admin_id
                                    INNER JOIN editors_roles
                                    ON editors_admin_has_role.role_id=editors_roles.role_id
                                    WHERE editors_admins.admin_id = :id_of_admin");
        $statement->bindParam(":id_of_admin", $id_of_admin, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getAllAdmins() {
        $db = self::getInstance();

        $statement = $db->prepare("SELECT admin_id, ime, priimek, email, password FROM editors_admins");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function addAdmin($name, $surname, $email, $password) {
        $db = self::getInstance();
        
        $statement = $db->prepare("INSERT INTO editors_admins(ime, priimek, email, password) VALUES(:name, :surname, :email, :password)");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function addRolesToAdmin($admin_id, $role_id) {
        $db = self::getInstance();

        $statement = $db->prepare("INSERT INTO editors_admin_has_role(admin_id, role_id) VALUES(:admin_id, :role_id)");
        $statement->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $statement->bindParam(":role_id", $role_id, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("SELECT LAST_INSERT_ID()");
        $statement->execute();

        return $statement->fetchColumn();
    }

    public static function updateAdmin($admin_id, $ime, $priimek, $email) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE editors_admins SET ime = :ime, priimek = :priimek, email = :email WHERE admin_id = :admin_id");
        $statement->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $statement->bindParam(":ime", $ime, PDO::PARAM_STR);
        $statement->bindParam(":priimek", $priimek, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function updateAdminPass($admin_id, $password) {
        $db = self::getInstance();

        $statement = $db->prepare("UPDATE editors_admins SET password = :password WHERE admin_id = :admin_id");
        $statement->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function deleteAdminRoles($admin_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM editors_admin_has_role WHERE admin_id = :admin_id");
        $statement->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $statement->execute();
    }

    public static function deleteUser($admin_id) {
        $db = self::getInstance();

        $statement = $db->prepare("DELETE FROM editors_admins WHERE admin_id = :admin_id");
        $statement->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $statement->execute();
    }
}
?>
