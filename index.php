<?php
  //need to start a session to get anything to react
  session_start();
  
  //This does the reset if requested
  if ( isset( $_POST['reset'] ) )
  {
    session_unset();
    session_destroy();
    session_start();
  }
  
  //This makes a new array if required for a new session
  if ( !isset( $_SESSION['todolist'] ) )
  {
    $_SESSION['todolist'] = array();
    $_SESSION['donelist'] = array();
  }
  
  $_SESSION['todolist'] = array_values( $_SESSION['todolist'] );
  $_SESSION['donelist'] = array_values( $_SESSION['donelist'] );
  $clickedBox = 'initial value';
  
  //This adds a new todo item
  if ( isset( $_POST['add'] ) && !empty( $_POST['todo'] ) )
  {
    array_push($_SESSION['todolist'], $_POST['todo']);
  }

  //If checkbox clicked, removed item from todo, adds it to done.
  foreach ( $_SESSION['todolist'] as $toDo ) {
    if ( isset( $_POST[$toDo] ) ) {
      array_push($_SESSION['donelist'], $toDo);
      $index=array_search($toDo, $_SESSION['todolist'] );
      array_splice($_SESSION['todolist'],$index,1);
    }
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
    </header>
    <h1>To-Do List</h1>
    <form action="./index.php" method="POST">
      <label for="todo">
        To-Do:
        <input type="text" name="todo" id="todo">
      </label>
      <input type="submit" name="add" value="Add" id="add">
      <input type="submit" name="reset" value="Reset" id="reset">
    <?php if ( !empty( $_SESSION['todolist'] ) ) : ?>
      <h2>Active To-Dos:</h2>
      <ul>
        <?php foreach ( $_SESSION['todolist'] as $toDo ) : ?>
          <li>
            <input type="checkbox" onChange='submit();' name="<?php echo $toDo; ?>" id="<?php echo $toDo; ?>">
            <?php echo $toDo; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    </form>
    <?php if ( !empty( $_SESSION['donelist'] ) ) : ?>
      <h2>Completed To-Dos</h2>
      <ul>
        <?php foreach ( $_SESSION['donelist'] as $done ) : ?>
          <li>
            <?php echo $done; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <h2>Debugging</h2>
    <h3>SESSION:</h3>
    <pre>
      <?php var_dump( $_SESSION ); ?>
    </pre>
    <h3>POST:</h3>
    <pre>
      <?php var_dump( $_POST ); ?>
    </pre>
  </body>
</html>