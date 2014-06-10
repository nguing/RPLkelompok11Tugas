			<div class="dropdown">
			<a href="" data-toggle="dropdown"><i class="fa fa-sign-in fa-2x"></i></a>
			<ul class="dropdown-menu left animated flipInY" role="menu" style="left:-180px">
			<?php
			if(isset($_SESSION['username']))
				{
				echo '
					<li><a href=""><i class="st-user"></i><i class="fa fa-align-justify fa-lg"></i> Nama :  '.$_SESSION['nama_penanggungjawab'].' </a></li>
					<li><a href=""><i class="st-cloud"></i><i class="fa fa-university fa-lg"></i> Unit Kerja : '.$_SESSION['unit_kerja'].' </a></li>
					<li><a href=" ../logout.php"><i class="im-exit"></i><i class="fa fa-sign-out fa-lg"></i>  Logout</a></li></ul>					
					';				
				}
			else
				{
				echo '<li><a href=" ../login.php"><i class="im-exit"></i><i class="fa fa-sign-out fa-lg"></i>  Login</a></li>';
				}
			?>		
			</ul>
			</div>    