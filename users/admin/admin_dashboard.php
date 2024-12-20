<?php

include '../../../vishay/connections.php';


if (isset($_POST['create'])) {
  $vishayTitle = $_POST['vishay'];

  $sql = "INSERT INTO `subject_list`(`vishay`) VALUES ('$vishayTitle')";

  $result = $conn->query($sql);

  if ($result) {
    echo "You have created a new vishay!";
  } else {
    echo "Error:" . $sql . "<br>" . $conn->error;
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>

    <h1>Admin Dashboard</h1>

    <button class="js-modal-trigger button" data-target="modal-js-example">
  + New Vishay
    </button>

    <div id="modal-js-example" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Create a New Vishay!</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">

      <form action="" method="POST">

      <div class="field">
  <div class="control">
    <input class="input" type="text" name="vishay" placeholder="New Vishay">
  </div>
</div>

      

    </section>
    <footer class="modal-card-foot">
      <div class="buttons">
        <button type="submit" name="create" class="button is-success">Create</button>
        <button class="button">Cancel</button>
      </div>
    </footer>

    </form>
  </div>
</div>



<div class="container vishay-suchi">

  <?php

    $sql = "SELECT * FROM subject_list";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>

    <div class="card">
      <div class="card-content">
        <div class="content">
        <?php echo $row['vishay']; ?>
        </div>
        <footer class="card-footer">
    <a href="#" class="card-footer-item">Save</a>
    <a href="#" class="card-footer-item">Edit</a>
    <a href="#" class="card-footer-item">Delete</a>
  </footer>
      </div>
    </div>
        
    <?php }
      }
    ?>


  


</div>






    
</body>
</html>

<script>
  document.addEventListener('DOMContentLoaded', () => {
  // Functions to open and close a modal
  function openModal($el) {
    $el.classList.add('is-active');
  }

  function closeModal($el) {
    $el.classList.remove('is-active');
  }

  function closeAllModals() {
    (document.querySelectorAll('.modal') || []).forEach(($modal) => {
      closeModal($modal);
    });
  }

  // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
    const modal = $trigger.dataset.target;
    const $target = document.getElementById(modal);

    $trigger.addEventListener('click', () => {
      openModal($target);
    });
  });

  // Add a click event on various child elements to close the parent modal
  (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
    const $target = $close.closest('.modal');

    $close.addEventListener('click', () => {
      closeModal($target);
    });
  });

  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
    if(event.key === "Escape") {
      closeAllModals();
    }
  });
});
</script>