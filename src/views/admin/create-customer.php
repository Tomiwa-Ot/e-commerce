<?php

require __DIR__ . '/header.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../../csrf.php';

if(isset($_POST['submit']) && CSRF::validateToken($_POST['token'])) {
    $lastname = filter_input(INPUT_POST, 'lastname'); 
    $firstname = filter_input(INPUT_POST, 'firstname');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone');
    $address = filter_input(INPUT_POST, 'address');
    $password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_DEFAULT);
  
    $statement = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
    $statement->execute(array($firstname, $lastname, $email, $phone, $address, $password));
    header('Location: /admin/customers');
}

?>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Create Customer</div>
            <div class="card-body">
                <form class="needs-validation" novalidate accept-charset="utf-8" method="post" action="/admin/customers/create">
                    <?php CSRF::csrfInputField() ?>
                    <div class="row g-2">
                        <div class="mb-3 col-md-4">
                            <input type="text" name="firstname" class="form-control" placeholder="Firstname" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="text" name="lastname" class="form-control" placeholder="Lastname" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>