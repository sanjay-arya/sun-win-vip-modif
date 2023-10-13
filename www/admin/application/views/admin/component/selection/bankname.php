<select id="bankName" name="bankName" class="my-input-class">
    <option value="">Select</option>
    <?php
    foreach ($banklist as $bank) {
        echo '<option value="'.$bank.'" ';
        if ($this->input->post("bankName") == $bank) {
            echo " selected ";
        }
        echo '>'.$bank.' </option>';
    }
    ?>
</select>