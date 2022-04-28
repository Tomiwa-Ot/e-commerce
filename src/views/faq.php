<?php 

require __DIR__ . '/header.php'; 
require __DIR__ . '/db.php'; 

$statement = $pdo->prepare("SELECT * FROM faq");
$statement->execute();

?>

<section class="page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>Frequently Asked Questions</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, repudiandae.</p>
				<p>admin@mail.com</p>
			</div>
			<div class="col-md-8">
				<?php if($statement->rowCount() > 0): $faq = $statement->fetchAll(PDO::FETCH_ASSOC);?>
					<?php foreach($faq as $data): ?>
						<h4><?= htmlspecialchars($data['question']) ?></h4>
						<p><?= htmlspecialchars($data['answer']) ?></p>
					<?php endforeach; ?>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>

<?php require __DIR__ . '/footer.php'; ?>