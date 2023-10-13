<td class="item"><select id="nhaCungCap" name="nhaCungCap" class="my-input-class">
        <option value="">Select</option>
        <option value="princepay" <?php if ($this->input->post('nhaCungCap') == 'princepay') {
            echo "selected";
        } ?>>princepay
        </option>
        <option value="clickpay" <?php if ($this->input->post('nhaCungCap') == 'clickpay') {
            echo "selected";
        } ?>>clickpay
        </option>
        <option value="paywell" <?php if ($this->input->post('nhaCungCap') == 'paywell') {
            echo "selected";
        } ?>>paywell
        </option>
        <option value="manualbank" <?php if ($this->input->post('nhaCungCap') == 'manualbank') {
            echo "selected";
        } ?>>manualbank
        </option>
    </select>
</td>