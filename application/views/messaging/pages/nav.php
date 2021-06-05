<header>
    <nav>
        <ul>
            <li style="font-size:x-large;"><?php echo 'Welcome' ?> <b><?php echo $this->session->userdata('userName') ?> </b><?php if($this->session->userdata('userTitle') === 'User Panel'){echo "(User)";}else{echo "(Admin)";} ?></li>
			<div id="links">
			<?php if($this->session->userdata('userStatus') != 0){
				?>
				<li style="font-size:x-large; margin-right: 10px"><a href="<?php echo site_url('/load_addAdmin') ?>">Add Admin</a></li>
				<li style="font-size:x-large; margin-right: 10px"><a href="<?php echo site_url('/messaging/logout') ?>">Logout</a></li>
				<?php
			}else{
				?>
					<li style="font-size:x-large; margin-right: 10px"><a href="<?php echo site_url('/load_addSMS') ?>">Add SMS</a></li>
					<li style="font-size:x-large; margin-right: 10px"><a href="<?php echo site_url('/messaging/logout') ?>">Logout</a></li>
				<?php
			}
			 ?>
			
			</div>
            
        </ul>
    </nav>
	</header>