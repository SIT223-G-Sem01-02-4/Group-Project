<?php
include 'main.php';

// Default input fault or recall values
$faultrecall = array(
    'type' => 'Fault',
    'make' => 'Audi',
    'model' => '',
    'description' => '',
);

// Array for enum values for db (anything added here will need to be reiterated in the table column entry)
$types = array('Fault','Recall');
$makes = array('Audi','BMW','Ferrari','Ford','Holden','Holden','Lexus','Mazda','Tesla','Toyota','Volkswagon');

if (isset($_GET['id'])) {
    // Get the fault or recall from the database
    $stmt = $pdo->prepare('SELECT * FROM faultsandrecalls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $faultrecall = $stmt->fetch(PDO::FETCH_ASSOC);
    // ID param exists, edit an existing fault or recall
    $page = 'Edit';
    if (isset($_POST['submit'])) {
        // Update the fault or recall
        $stmt = $pdo->prepare('UPDATE faultsandrecalls SET type = ?, make = ?, model = ?, description = ? WHERE id = ?');
        $stmt->execute([ $_POST['type'], $_POST['make'], $_POST['model'], $_POST['description'], $_GET['id'] ]);
        header('Location: faultsandrecalls.php');
        exit;
    }
    if (isset($_POST['delete'])) {
        // Delete the fault or recall
        $stmt = $pdo->prepare('DELETE FROM faultsandrecalls WHERE id = ?');
        $stmt->execute([ $_GET['id'] ]);
        header('Location: faultsandrecalls.php');
        exit;
    }
} else {
    // Create a new fault or recall
    $page = 'Create';
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT IGNORE INTO faultsandrecalls (type,make,model,description) VALUES (?,?,?,?)');
        $stmt->execute([ $_POST['type'], $_POST['make'], $_POST['model'], $_POST['description']]);
        //Check for users that have matching personal vehicles
        $checkmake = $_POST['make'];
        $checkmodel = $_POST['model'];
        $description = $_POST['description'];
 
        $sql = "SELECT * FROM accounts WHERE make = :make AND model = :model";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':make',$checkmake,PDO::PARAM_STR);
        $stmt->bindParam(':model',$checkmodel,PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $data = $stmt->fetchAll();

        foreach ($data as $userprofiledata):
            send_newfaultorrecallmatch_email($userprofiledata['email'], $description);
        endforeach;
    }
}
?>


<?=template_admin_header($page . ' Fault/Recall - Admin Panel')?>

<h2><?=$page?> Fault or Recall</h2>

<div class="content-block">
    <form action="" method="post" class="form responsive-width-100">
        <label for="type">Type</label>
        <select id="type" name="type" style="margin-bottom: 30px;">
            <?php foreach ($types as $type): ?>
            <option value="<?=$type?>"<?=$type==$faultrecall['type']?' selected':''?>><?=$type?></option>
            <?php endforeach; ?>
        </select>
        <label for="make">Make</label>
        <select id="make" name="make" style="margin-bottom: 30px;">
            <?php foreach ($makes as $make): ?>
            <option value="<?=$make?>"<?=$make==$faultrecall['make']?' selected':''?>><?=$make?></option>
            <?php endforeach; ?>
        </select>
        <label for="model">Model</label>
        <input type="text" id="model" name="model" placeholder="Model" value="<?=$faultrecall['model']?>" required>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Fault/Recall Description" value="<?=$faultrecall['description']?>" required>
        <div class="submit-btns">
            <input type="submit" name="submit" value="Submit">
            <?php if ($page == 'Edit'): ?>
            <input type="submit" name="delete" value="Delete" class="delete">
            <?php endif; ?>
        </div>
    </form>
</div>

<?=template_admin_footer()?>