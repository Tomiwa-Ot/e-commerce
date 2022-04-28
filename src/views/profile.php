<?php 

require __DIR__ . '/header.php';
require __DIR__ . '/../csrf.php';
require __DIR__ . '/db.php';

if(!isset($_SESSION['name'])) {
  header('Location: /login');
}

if(isset($_POST['update']) && CSRF::validateToken($_POST['token'])) {
  if(isset($_POST['firstname'])) {
    $firstname = filter_input(INPUT_POST, 'firstname');
    $statement = $pdo->prepare("UPDATE users SET firstname=? WHERE email=?");
    $statement->execute(array($firstname, $_SESSION['email']));
    $_SESSION['name'] = explode(' ', $_SESSION['name'])[0] . ' ' . $firstname;
  }
  if(isset($_POST['lastname'])) {
    $lastname = filter_input(INPUT_POST, 'lastname');
    $statement = $pdo->prepare("UPDATE users SET lastname=? WHERE email=?");
    $statement->execute(array($lastname, $_SESSION['email']));
    $_SESSION['name'] = $lastname . ' ' . explode(' ', $_SESSION['name'])[1];
  }
  if(isset($_POST['address'])) {
    $address = filter_input(INPUT_POST, 'address');
    $statement = $pdo->prepare("UPDATE users SET address=? WHERE email=?");
    $statement->execute(array($address, $_SESSION['email']));
    $_SESSION['address'] = $address;
  }
  if(isset($_POST['phone'])) {
    $phone = filter_input(INPUT_POST, 'phone');
    $statement = $pdo->prepare("UPDATE users SET phone=? WHERE email=?");
    $statement->execute(array($phone, $_SESSION['email']));
    $_SESSION['phone'] = $phone;
  }
}


?>
<section class="user-dashboard page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline dashboard-menu text-center">
          <li><a class="active" href="/profile">Profile Details</a></li>
          <li><a href="/orders">Orders</a></li>
        </ul>
        <div class="dashboard-wrapper dashboard-user-profile">
            <div class="media">
              <div class="media-body">
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                  <ul class="user-profile-list">
                    <?php CSRF::csrfInputField() ?>
                    <li><span>Firstname:</span><input type="text" name="firstname" value="<?= htmlspecialchars(explode(' ', $_SESSION['name'])[1]) ?>"></li>
                    <li><span>Lastname:</span><input type="text" name="lastname" value="<?= htmlspecialchars(explode(' ', $_SESSION['name'])[0]) ?>"></li>
                    <li><span>Address:</span><input type="text" name="address" value="<?= htmlspecialchars($_SESSION['address']) ?>"></li>
                    <li><span>Phone:</span><input type="tel" name="phone" value="<?= htmlspecialchars($_SESSION['phone']) ?>"></li>
                    <li><button class="btn btn-main" type="submit" name="update">Update</button></li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
<?php require __DIR__ . '/footer.php'; ?>