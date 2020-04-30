<?php
  session_start();
  
  if ( !isset( $_SESSION['todolist'] ) )
  {
    $_SESSION['todolist'] = array();
  }
  
  $_SESSION['todolist'] = array_values( $_SESSION['todolist'] );
  
  if ( isset( $_POST ) && !empty( $_POST ) )
  {
    array_push($_SESSION['todolist'], $_POST['todo']);
  }

?><!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
  </head>
  <body>
    <header>
      <h1>To-Do List</h1>
      <form action="./index.php" method="POST">
        <label for="todo">
          To-Do:
          <input type="text" name="todo" id="todo">
        </label>
        <input type="submit" value="Add" id="add">
        <input type="submit" value="Reset" id="reset">
      <?php if ( !empty( $_SESSION['todolist'] ) ) : ?>
        <h2>To-Do's:</h2>
        <ul>
          <?php foreach ( $_SESSION['todolist'] as $toDo ) : ?>
            <li>
              <input type="checkbox" name="<?php echo $toDo; ?>" id="<?php echo $toDo; ?>">
              <label for="<?php echo $toDo; ?>">
              <?php echo $toDo; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      </form>
      <pre>
        <strong>$_POST contents:</strong>
        <?php var_dump( $_POST ); ?>
      </pre>
      <pre>
        <strong>$_SESSION contents:</strong>
        <?php var_dump( $_SESSION ); ?>
      </pre>
    </header>
  </body>
</html>