<?php

session_start();

session_destroy();



header("Location: ../index.php");

?>
<!-- DELETE Westorage -->
<script>
		
		
		//sessionStorage.removeItem('/gpsc/pages/formOrganisme.php#formcache-key');
		sessionStorage.clear();

</script>
