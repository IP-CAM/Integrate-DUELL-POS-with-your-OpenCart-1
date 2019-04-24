<div id="blocker" style="display: none;"><div><?php echo $text_duell_integration_processing; ?>...</div></div>
<?php

echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>

  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">







      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" >



        <table class="form">
          <tr>
            <td><?php echo $text_duell_integration_client_number; ?>
              <span class="help"><?php echo $help_text_duell_integration_client_number; ?></span>
            </td>
            <td><input type="text" name="duell_integration_client_number" value="<?php echo $duell_integration_client_number; ?>" placeholder="<?php echo $text_duell_integration_client_number; ?>" />
              <?php if ($error_duell_integration_client_number) { ?>
              <span class="error"><?php echo $error_duell_integration_client_number; ?></span>
              <?php } ?>
            </td>
          </tr>


          <tr>
            <td><?php echo $text_duell_integration_client_token; ?>
              <span class="help"><?php echo $help_text_duell_integration_client_token; ?></span>
            </td>
            <td><input size="50" type="text" name="duell_integration_client_token" value="<?php echo $duell_integration_client_token; ?>" placeholder="<?php echo $text_duell_integration_client_token; ?>" />
              <?php if ($error_duell_integration_client_token) { ?>
              <span class="error"><?php echo $error_duell_integration_client_token; ?></span>
              <?php } ?>
            </td>
          </tr>


          <tr>
            <td><?php echo $text_duell_integration_department_token; ?>
              <span class="help"><?php echo $help_text_duell_integration_department_token; ?></span>
            </td>
            <td>
              <input size="50" type="text" name="duell_integration_department_token" value="<?php echo $duell_integration_department_token; ?>" placeholder="<?php echo $text_duell_integration_department_token; ?>"  />
              <?php if ($error_duell_integration_department_token) { ?>
              <span class="error"><?php echo $error_duell_integration_department_token; ?></span>
              <?php } ?>
            </td>
          </tr>


          <tr>
            <td><?php echo $text_duell_integration_log_status; ?></td>
            <td>
              <select name="duell_integration_log_status" id="input-log-status" >
                <?php if ($duell_integration_log_status==1 || $duell_integration_log_status=='') { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </td>
          </tr>


          <tr>
            <td><?php echo $entry_status; ?></td>
            <td>
              <select name="duell_integration_status" id="input-status" >
                <?php if ($duell_integration_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </td>
          </tr>


          <tr>
            <td>&nbsp;</label>
            </td>
            <td>
              <a id="button-syncmanually" data-toggle="tooltip" title="<?php echo $text_duell_integration_manual_sync; ?>" class="button"><?php echo $text_duell_integration_manual_sync; ?></a>

            </td>
          </tr>
        </table>

      </form>


      <div class="col-sm-12 col-userguide" >

        <p><?php echo $text_user_guide; ?></p>



        <p>&nbsp;</p>
        <p>  <b><?php echo $text_cron_steup_title_curl; ?></b></p>
        <ul  style="list-style-type:circle">
          <li>
            <?php echo $text_every_hours; ?>:&nbsp; <b>* */3 * * * /usr/bin/curl <?php echo $cron_link; ?> >/dev/null 2>&1</b>
          </li>
          <li>
            <?php echo $text_every_night; ?>:&nbsp; <b>* 3 * * * /usr/bin/curl <?php echo $cron_link; ?> >/dev/null 2>&1</b>
          </li>
        </ul>
        <p>&nbsp;</p>


      </div>

    </div>
  </div>
</div>
<style>
  .col-userguide{
    background: #f6f6f6;
    padding: 10px;
    margin-bottom: 17px;
    border: 1px solid #e4e4e4;
    border-radius: 3px;
  }
  #blocker
  {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: .9;
    background-color: #000;
    z-index: 1000;
    overflow: auto;

  }
  #blocker div
  {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5em;
    height: 2em;
    margin: -1em 0 0 -2.5em;
    color: #fff;
    font-weight: bold;
    font-size: 24px;
  }


</style>
<script type="text/javascript"><!--

  function blockUI(        )
  {
    $("#blocker").css('display', "");
  }

  function unblockUI(        )
  {
    $("#blocker").css('display', "none");
  }



  var inProcess = false;
  $('#button-syncmanually').on('click', function () {
    if (inProcess == false) {
      inProcess = true;
      $.ajax({
        url: 'index.php?route=module/duell_integration/manualsync&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        cache: false,
        beforeSend: function () {
          $('#button-syncmanually').text('<?php echo $text_duell_integration_processing; ?>...');
          blockUI();
        },
        complete: function () {
          $('#button-syncmanually').text('<?php echo $text_duell_integration_manual_sync; ?>');
          unblockUI();
          inProcess = false;
        },
        success: function (json) {
          console.log(json);
          if (json['success']) {
            alert(json['message']);
          } else {
            alert(json['message']);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }

  });
  //--></script>
<?php echo $footer; ?>