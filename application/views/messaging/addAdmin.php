<?php $this->load->view('messaging/includes/header',$title) ?>

<div class="card">
<?php echo form_open('messaging/addAdmin') ?>
      <h2 class="title"> Add Admin</h2>
      <div class="email-login">
         <label for="email"> <b>User Email</b></label>
         <input type="email" placeholder="Enter User Email" name="email" value="<?php echo set_value('email') ?>" required>
      </div>
      <button class="cta-btn" type="submit" name="submit">Submit</button>
<?php echo form_close() ?>
</div>

<?php $this->load->view('messaging/includes/footer') ?>