<?php $this->load->view('messaging/includes/header',$title) ?>

<div class="card">
<?php echo form_open('messaging/login') ?>
      <h2 class="title"> Log in</h2>
      <p class="subtitle">Don't have an account? <a href="<?php echo site_url('load_register') ?>">Register</a></p>
      <div class="email-login">
         <label for="email"> <b>Email</b></label>
         <input type="email" placeholder="Enter Email" name="email" value="<?php echo set_value('email') ?>" required>
         <label for="psw"><b>Password</b></label>
         <input type="password" placeholder="Enter Password" name="password" value="<?php echo set_value('password') ?>" required>
      </div>
      <button class="cta-btn" type="submit" name="submit">Log In</button>
<?php echo form_close() ?>
</div>

<?php $this->load->view('messaging/includes/footer') ?>
