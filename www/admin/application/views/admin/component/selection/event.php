
    <select id="inputEvent" name="inputEvent" class="form-control my-input-class">
        <option value="">Select</option>
        <option value="1" <?php if ($this->input->post('inputEvent') == '1') {
            echo "selected";
        } ?>>Event +58k
        </option>
        <option value="2" <?php if ($this->input->post('inputEvent') == '2') {
            echo "selected";
        } ?>>Event +78k
        </option>
        <option value="3" <?php if ($this->input->post('inputEvent') == '3') {
            echo "selected";
        } ?>>Event 3
        </option>
        <option value="4" <?php if ($this->input->post('inputEvent') == '4') {
            echo "selected";
        } ?>>Event 4
        </option>
        <option value="5" <?php if ($this->input->post('inputEvent') == '5') {
            echo "selected";
        } ?>>5
        </option>
        <option value="6" <?php if ($this->input->post('inputEvent') == '6') {
            echo "selected";
        } ?>>6
        </option>
        <option value="7" <?php if ($this->input->post('inputEvent') == '7') {
            echo "selected";
        } ?>>7
        </option>
        <option value="8" <?php if ($this->input->post('inputEvent') == '8') {
            echo "selected";
        } ?>>8
        </option>
        <option value="9" <?php if ($this->input->post('inputEvent') == '9') {
            echo "selected";
        } ?>>9
        </option>
        <option value="10" <?php if ($this->input->post('inputEvent') == '10') {
            echo "selected";
        } ?>>10
        </option>
        
    </select>
