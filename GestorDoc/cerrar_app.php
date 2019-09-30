<?php
  session_unset();
  session_write_close();
  session_destroy();
  echo "<script>window.location='login.php'</script>";
 ?>
