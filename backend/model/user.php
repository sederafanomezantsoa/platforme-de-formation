<?php
//require_once __DIR__ ."/../../frontend/singup.php";

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addUser(string $name,string $email,string $password,string $password_v)
    {
	if($password !== $password_v){
		return null;
	}
        $sql = "INSERT INTO users(name,email,password) VALUES (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute([$name,$email,$password]);
        return true;
	
    }
    public function getNbEtudiantsCours(): array
    {
        $sql = "SELECT cours.title,count(cours.id_cours) as nombre_etudiants FROM inscription
	JOIN users on inscription.id_user = users.id_user
	JOIN cours on inscription.id_cours = cours.id_cours
	GROUP BY cours.id_cours;";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getModulsCours(): array
    {
        $sql = "SELECT module.mod_title,lecons.lec_title
	FROM lecons
	JOIN module on lecons.id_module=module.id_module;";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function login(string $email, string $password):? array
    {
	$sql = "SELECT id_user,email,password,role FROM users WHERE email =?";
	$stmt = $this->pdo->prepare($sql);
	$stmt->execute([$email]); 	
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!$user) { 
		return null;
     	}
	//if(!password_verify($password,$user['password'])){
	if($password != $user['password']){
		return null;
	} 
	return $user;
    }
   public function deleteUser($id_user)
   {
	$sql = "DELETE FROM inscription WHERE id_user = ? ;DELETE FROM users WHERE id_user = ? ";
	$stmt = $this->pdo->prepare($sql);
	$stmt -> execute([$id_user,$id_user]);
   }
   public function findUser(string $user_name): array
   {
	$sql = "SELECT * FROM users WHERE name LIKE ?";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute(['%'.$user_name.'%']);
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $users;
    }
    public function getDetailsUser(int $id_user){
 	$sql = "SELECT u.name as name,c.title as cTitle FROM inscription i
        JOIN users u ON i.id_user = u.id_user
        JOIN cours c on i.id_cours = c.id_cours
        WHERE u.id_user = ?";
        // "SELECT u.name as name,l.lec_title as lecTitle,m.mod_title as modTitle,m.mod_ordre as modOrdre,c.title as cTitle
        // FROM users u 
        // JOIN progression p on u.id_user = p.id_user 
        // JOIN lecons l on p.id_lecon = l.id_lecon 
        // JOIN module m on l.id_module = m.id_module 
        // JOIN cours c ON m.id_cours = c.id_cours
        // WHERE u.id_user = ?";

;
	$stmt = $this->pdo->prepare($sql);
	$stmt->execute([$id_user]);
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
