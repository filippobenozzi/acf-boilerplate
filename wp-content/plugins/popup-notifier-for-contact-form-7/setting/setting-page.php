<?php function popupnotifiercf7_options_page() { ?>

  <div class="wrap">
    <h1>Popup Message Notifier for Contact Form 7 - Settings</h1>
    <form method="post" action="options.php">

        <?php settings_fields( 'popupnotifiercf7_options_group' ); ?>

        <p>Custom options for CF7 pop-up.<br /><b>NB.</b> Remember these option will affect confirm, warning and error alerts.</p>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Auto-Close popup</th>
                    <td>
                        <?php
                            $popupnotifiercf7_option_isAutoClose = (int)get_option('popupnotifiercf7_option_isAutoClose');
                        ?>
                        <label><input type="radio" name="popupnotifiercf7_option_isAutoClose" value="1" <?= ($popupnotifiercf7_option_isAutoClose ? 'checked' : '' ) ?> /> Enable</label> &nbsp;
                        <label><input type="radio" name="popupnotifiercf7_option_isAutoClose" value="0" <?= (!$popupnotifiercf7_option_isAutoClose ? 'checked' : '' ) ?> /> Disable</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Close popup button</th>
                    <td>
                        <?php
                            $popupnotifiercf7_option_isConfirmButton = (int)get_option('popupnotifiercf7_option_isConfirmButton');
                        ?>
                        <label><input type="radio" name="popupnotifiercf7_option_isConfirmButton" value="1" <?= ($popupnotifiercf7_option_isConfirmButton ? 'checked' : '' ) ?> /> Enable</label> &nbsp;
                        <label><input type="radio" name="popupnotifiercf7_option_isConfirmButton" value="0" <?= (!$popupnotifiercf7_option_isConfirmButton ? 'checked' : '' ) ?> /> Disable</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Popup animated icon</th>
                    <td>
                        <?php
                            $popupnotifiercf7_option_isShowIcon = (int)get_option('popupnotifiercf7_option_isShowIcon');
                        ?>
                        <label><input type="radio" name="popupnotifiercf7_option_isShowIcon" value="1" <?= ($popupnotifiercf7_option_isShowIcon ? 'checked' : '' ) ?> /> Enable</label> &nbsp;
                        <label><input type="radio" name="popupnotifiercf7_option_isShowIcon" value="0" <?= (!$popupnotifiercf7_option_isShowIcon ? 'checked' : '' ) ?> /> Disable</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Auto-Close Timeout<br/>(in milliseconds)</th>
                    <td>
                        <?php
                            $popupnotifiercf7_option_customSeconds = (int)get_option('popupnotifiercf7_option_customSeconds');
                        ?>
                        <input type="number" name="popupnotifiercf7_option_customSeconds" value="<?= ($popupnotifiercf7_option_customSeconds) ? $popupnotifiercf7_option_customSeconds : '2500' ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Close popup button text</th>
                    <td>
                        <?php
                            $popupnotifiercf7_option_customTextButton = get_option('popupnotifiercf7_option_customTextButton');
                        ?>
                        <input type="text" maxlength="100" name="popupnotifiercf7_option_customTextButton" value="<?= ($popupnotifiercf7_option_customTextButton) ? $popupnotifiercf7_option_customTextButton : 'Close' ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Close popup button background color</th>
                    <td>
                        <?php
                            $popupnotifiercf7_option_customTextButtonBackground= get_option('popupnotifiercf7_option_customTextButtonBackground');
                        ?>
                        <input type="text" name="popupnotifiercf7_option_customTextButtonBackground" value="<?= ($popupnotifiercf7_option_customTextButtonBackground) ? $popupnotifiercf7_option_customTextButtonBackground : '#000000' ?>" />
                        <script>
                            jQuery(document).ready(function($){
                                jQuery('[name="popupnotifiercf7_option_customTextButtonBackground"]').wpColorPicker();
                            });
                        </script>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php  submit_button(); ?>
    </form>
  </div>

<?php } ?>