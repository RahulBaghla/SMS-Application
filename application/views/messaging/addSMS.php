<?php $this->load->view('messaging/includes/header',$title) ?>

<div class="card">
<?php echo form_open('messaging/addSMS') ?>
      <h2 class="title"> Add SMS</h2>
      <div class="email-login">
         <label for="schoolname"> <b>School Name</b></label>
         <input type="text" placeholder="Enter School Name" name="schoolname" value="<?php echo set_value('schoolname') ?>" required>
         <label for="totalsms"><b>Number of SMS</b></label>
         <input type="number" min=0 placeholder="Enter Number of SMS" name="totalsms" value="<?php echo set_value('totalsms') ?>" required>
      </div>
      <button class="cta-btn" type="submit" name="submit">Submit</button>
<?php echo form_close() ?>
</div>

<?php $this->load->view('messaging/includes/footer') ?>