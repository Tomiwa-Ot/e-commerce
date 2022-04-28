<?php 

require __DIR__ . '/header.php';
require __DIR__ . '/db.php';

$statement = $pdo->prepare("SELECT * FROM policy");
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<section class="about section">
    <div class="container">
		<div class="row">
			<div class="col-lg-5-offset-3 col-md-5 col-sm-12">
				<h2>Privacy Policy</h2>
				<p><?= htmlspecialchars($data[0]['policy']) ?></p>
			</div>
		</div>
    </div>
</section>
<?php require __DIR__ . '/footer.php'; ?>