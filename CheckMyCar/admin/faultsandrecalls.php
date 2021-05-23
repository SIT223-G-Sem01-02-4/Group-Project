<?php
include 'main.php';
$stmt = $pdo->prepare('SELECT * FROM faultsandrecalls');
$stmt->execute();
$faultsandrecalls = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_admin_header('FaultsAndRecalls')?>

<h2>Faults and Recalls</h2>

<div class="links">
    <a href="faultandrecall.php">Create Fault or Recall</a>
</div>

<div class="content-block">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>Date</td>
                    <td class="responsive-hidden">Type</td>
                    <td class="responsive-hidden">Make</td>
                    <td class="responsive-hidden">Model</td>
                    <td class="responsive-hidden">Description</td>

                </tr>
            </thead>
            <tbody>
                <?php if (empty($faultsandrecalls)): ?>
                <tr>
                    <td colspan="8" style="text-align:center;">There are currently no faults or recalls!</td>
                </tr>
                <?php else: ?>
                <?php foreach ($faultsandrecalls as $faultrecall): ?>
                <tr class="details" onclick="location.href='faultandrecall.php?id=<?=$faultrecall['id']?>'">
                    <td><?=$faultrecall['id']?></td>
                    <td><?=$faultrecall['timestamp']?></td>
                    <td class="responsive-hidden"><?=$faultrecall['type']?></td>
                    <td class="responsive-hidden"><?=$faultrecall['make']?></td>
                    <td class="responsive-hidden"><?=$faultrecall['model']?></td>
                    <td class="responsive-hidden"><?=$faultrecall['description']?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?=template_admin_footer()?>
