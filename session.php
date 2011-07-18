<?
session_start();
if(!isset($_SESSION['login'])) {
		        $admin=0;
			$membre=0;
			$connected=0;
			      }
			      else {
		$connected=1;
                if($_SESSION['access']==0) { $membre=0; $admin=0; }
                if($_SESSION['access']==1) { $membre=1; $admin=0; }
               if($_SESSION['access']==2) { $membre=1; $admin=0;  }
               if($_SESSION['access']==3) { $membre=1; $admin=1;  }
}
?>
