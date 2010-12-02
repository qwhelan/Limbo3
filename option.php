<?php
require_once('db.php');
require_once('config.php');
require_once('actions.php');

$username = $_GET['acting_user'];
if(!empty($username)) {
  // check if the user is a thing
  $user = parse_user($username);
  if (is_null($user)) {
    redirect("i've never heard of you before",'register.php');
  }
} else {
  redirect();
}
$message = '';
$error = false;
if (array_key_exists('submit', $_POST)) {
  //if($_POST['submit'] == 'clear'){    
  //}
  if($_POST['submit']=='option'){
  assert_key('quantity', $_POST);
  assert_key('item', $_POST);
  assert_key('price', $_POST);
  $price = (double) $_POST['price'];
  if ($price <= 0 || $price > 100 || is_null($price)){
    $message = 'That was an invalid price';
    $error = true;
  }
  $quantity = (int) $_POST['quantity'];
  if ($quantity <= 0 || $quantity > 400 || is_null($quantity)){
    $message = 'That was an invalid quantity';
    $error = true;
  }
  if (empty($_POST['item'])){
    $message = 'That was an invalid item';
    $error = true;
  }
  if(!$error){
    $item = parse_item($_POST['item']);
    if (is_null($item)) {
      $item = new Item();
      $item->setName(strip_tags($_POST['item']));
      $item->save();
    }
    $option = new Option();
    $option->setItemId($item->getId());
    $option->setUserId($user->getId());
    $option->setPrice($price);
    $option->setQuantity($quantity);
    $option->save();
  }
  }
}


?>
<?php include( 'templates/header.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
  $("input[type=text]#item").autocomplete("item_suggest.php", {matchCase: false, minChars: 2});
  $("[placeholder]").textPlaceholder()

});
</script>

<center>
<h1> <?= $user->getUsername() ?>'s options</h1>
<?php
  $options = $user->getOptions();
  if (count($options) > 0) {
    echo "<h2> Personal Issued Options </h2>\n";
    echo "<table>";
    echo "<tr><th>Item</th><th>Issued</th><th>Max Price</th><th>Fulfilled</th></tr>";
    foreach($options as $option) { ?>
      <tr>
      <td><?= $option->getItem()->getName() ?> </td>
      <td><?= $option->getCreated() ?> </td>
      <td><?= format_currency($option->getPrice()) ?> </td>
      <td><?= $option->getSold() ?>/<?=$option->getQuantity() ?> </td>
      </tr>
    <?php
    }
    echo "</table>\n";
  }
  $all_options = OptionQuery::create()->find();
  if (count($all_options) > 0) {
    echo "<h2> All Available Options </h2>\n";
  }
  echo "<table>";
  echo "<tr><th>Item</th><th>Issuer</th><th>Issued</th><th>Expires</th><th>Max Price</th><th>Fulfilled</th></tr>";
  foreach($all_options as $option) { ?>
    <tr>
    <td><?= $option->getItem()->getName() ?> </td>
    <td><?= $option->getUser()->getUsername() ?> </td>
    <td><?= $option->getCreated() ?> </td>
    <td><?= $option->getExpires() ?> </td>
    <td><?= format_currency($option->getPrice()) ?> </td>
    <td><?= $option->getSold() ?>/<?=$option->getQuantity() ?> </td>
    </tr>
  <?php
  }
  echo "</table>\n";


?>

<h2> Option </h2>
<?php
  if (!empty($message)) {
    echo "<strong>$message</strong>";
  }
?>
<form method="post">
I'd like to sell the obligation to buy up to 
<input type="number" name="quantity" min="0" max="100" step="1" placeholder="0"> <br />
<input id="item" type="text" name="item" placeholder="widget"/>s at a maximum price of
$<input type="number" name="price" min="0" max="100" step="0.01"> <br />
within a week of being stocked.

<input type="hidden" value="<?=$user->getId() ?>" name="acting_user" /> 
<input type="hidden" name="action" value="option" />
<input type="hidden" value="option" name="submit" />
<br />
<input value="¡Viva Capitalismo!" class="submit" type="Submit"/>

</form>
</center>
<?php include( 'templates/footer.php'); ?>
