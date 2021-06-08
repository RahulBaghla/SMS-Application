<!-- <?php //$this->load->view('messaging/includes/header',$title) ?>

<div class="card">
<?php //echo form_open('messaging/addAdmin') ?>
      <h2 class="title"> Add Admin</h2>
      <div class="email-login">
         <label for="email"> <b>User Email</b></label>
         <input type="email" placeholder="Enter User Email" name="email" value="<?php //echo set_value('email') ?>" required>
      </div>
      <button class="cta-btn" type="submit" name="submit">Submit</button>
<?php //echo form_close() ?>
</div>

<?php //$this->load->view('messaging/includes/footer') ?> -->


<?php $this->load->view('messaging/includes/header',$title) ?>

<div class="card">
<?php echo form_open('messaging/addUser') ?>
      <h2 class="title">Add User</h2>
      <!-- <p class="subtitle">Already have an account? <a href="<?php //echo site_url('/') ?>"> Log in</a></p> -->
      <div class="email-login">
         <label for="name"> <b>Name</b></label>
         <input type="text" placeholder="Enter Name" name="name" value="<?php echo set_value('name') ?>" required>
         <label for="email"> <b>Email</b></label>
         <input type="email" placeholder="Enter Email" name="email" value="<?php echo set_value('email') ?>" required>
         <label for="password"><b>Password</b></label>
         <input type="password" placeholder="Enter Password" name="password" value="<?php echo set_value('password') ?>" required>
         <label for="confirmpassword"><b>Confirm Password</b></label>
         <input type="password" placeholder="Comfirm Password" name="confirmpassword" value="<?php echo set_value('confirmpassword') ?>" required>
      </div>
      <button class="cta-btn" type="submit" name="submit">Submit</button>
<?php echo form_close() ?>
</div>

<?php $this->load->view('messaging/includes/footer') ?>