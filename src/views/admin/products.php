<?php 

require __DIR__ . '/header.php'; 
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';
require __DIR__ . '/util.php';

$items;
$categories;
$edit = false;


if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if(isset($_POST['title'])) {
        $statement = $pdo->prepare("UPDATE products SET title=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'title'), $id));
    }
    if(isset($_POST['price'])) {
        $statement = $pdo->prepare("UPDATE products SET price=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'price'), $id));
    }
    if(isset($_POST['description'])) {
        $statement = $pdo->prepare("UPDATE products SET description=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'description'), $id));
    }
    if(isset($_POST['category'])) {
        $statement = $pdo->prepare("SELECT * FROM categories WHERE title=?");
        $statement->execute(array(filter_input(INPUT_POST, 'category')));
        if(!$statement->rowCount() > 0) {
            $statement = $pdo->prepare("INSERT INTO categories(title) VALUES (?)");
            $statement->execute(array(filter_input(INPUT_POST, 'category')));
        }
        $statement = $pdo->prepare("UPDATE products SET category=? WHERE id=?");
        $statement->execute(array(filter_input(INPUT_POST, 'category'), $id));
    }
    if(isset($_FILES['files'])) {
        $path = serialize(uploadImages());
        $statement = $pdo->prepare("UPDATE products SET images=? WHERE id=?");
        $statement->execute(array($path, $id));
    }
}

if(isset($_GET['id'])) {
    $edit = true;
    $statement = $pdo->prepare("SELECT * FROM products WHERE id=?");
    $statement->execute(array(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    if($statement->rowCount() > 0) {
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    $statement = $pdo->prepare("SELECT * FROM categories");
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
    if(isset($_POST['delete']) && CSRF::validateToken($_POST['token'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $statement = $pdo->prepare("DELETE FROM products WHERE id=?");
        $statement->execute(array($id));
    }
    
    $statement = $pdo->prepare("SELECT * FROM products");
    $statement->execute();
    if($statement->rowCount() > 0) {
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$statement = $pdo->prepare("SELECT * FROM categories");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container">
    <div class="page-title">
        <h3>Products
        <a href="/admin/products/create" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-plus"></i> Add</a>
        </h3>
    </div>
    <?php if($edit): ?>
        <div class="card">
            <div class="card-header">Create Product</div>
            <div class="card-body">
                <div class="col-md-6">
                    <form action="/admin/products" method="post" enctype="multipart/form-data">
                        <?php CSRF::csrfInputField() ?>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?= $items[0]['title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="<?= $items[0]['price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" style="resize:none"><?= $items[0]['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="language" class="form-label">Category</label>
                            <div class="input-group mb3">
                        	    <div class="dropdown input-group-prepend">
                            	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            		Choose
                            	  </button>
                            	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            		<?php foreach($categories as $category): ?>
                            		    <li><a class="dropdown-item"><?= $category['title'] ?></a></li>
                            		    <div role="separator" class="dropdown-divider"></div>
                            		<?php endforeach; ?>
                            	  </ul>
                        	    </div>
                            	<input id="category" type="text" name="category" class="form-control" aria-label="Text input with dropdown button" value="<?= $items[0]['category'] ?>">
                        	</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Images</label>
                            <input class="form-control" name="files[]" type="file" id="formFile1" multiple>
                            <small class="text-muted">Select product images</small>
                        </div>
                        <div class="mb-3 text-end">
                            <input type="text" name="id" value="<?= $items[0]['id'] ?>" hidden>
                            <button name="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    <?php else: ?>
        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($items)): ?>
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td><?= $item['title'] ?></td>
                                    <td>₦ <?= number_format($item['price'], 2) ?></td>
                                    <td><?= $item['description'] ?></td>
                                    <td><?= $item['category'] ?></td>
                                    <td class="text-end">
                                        <form action="/admin/products" method="post">
                                            <?php CSRF::csrfInputField() ?>
                                            <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                                            <a href="/admin/products?id=<?= $item['id']; ?>" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                            <button name="delete" type="submit" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
</div>

<?php require __DIR__ . '/footer.php'; ?>
<script>
    $('.dropdown-item').click(function() {
        $('#category').val($(this).text())
    })
</script>