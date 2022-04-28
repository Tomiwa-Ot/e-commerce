<?php 

require __DIR__ . '/header.php'; 
require __DIR__ . '/db.php';

$items;
$statement = $pdo->prepare("SELECT * FROM products ORDER BY rand() LIMIT 9");
$statement->execute();
if($statement->rowCount() > 0) {
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>
<section class="products section bg-gray">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>What would you like today?</h2>
			</div>
		</div>
		<div class="row">
		    <?php if(isset($items)): ?>
    			<?php foreach($items as $item): ?>
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-thumb">
                                <img class="img-responsive" src="<?= htmlspecialchars(unserialize($item['images'])[0]) ?>" alt="<?= htmlspecialchars($item['title']) ?>" />
                            </div>
                            <div class="product-content">
                                <h4><a href="/item?id=<?= htmlspecialchars($item['id']) ?>"><?= htmlspecialchars($item['title']) ?></a></h4>
                                <p class="price">₦ <?= number_format($item['price'], 2) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif ?>

		</div>
	</div>
</section>


<!--
Start Call To Action
==================================== -->
<section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>SUBSCRIBE TO NEWSLETTER</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, <br> facilis numquam impedit ut sequi. Minus facilis vitae excepturi sit laboriosam.</p>
				</div>
				<div class="col-lg-6 col-md-offset-3">
				    <div class="input-group subscription-form">
				      <input type="text" class="form-control" placeholder="Enter Your Email Address">
				      <span class="input-group-btn">
				        <button class="btn btn-main" type="button">Subscribe Now!</button>
				      </span>
				    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->

			</div>
		</div> 		<!-- End row -->
	</div>   	<!-- End container -->
</section>   <!-- End section -->

<?php require __DIR__ . '/footer.php'; ?>