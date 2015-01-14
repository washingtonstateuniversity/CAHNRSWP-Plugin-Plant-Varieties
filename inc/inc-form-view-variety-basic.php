<?php wp_nonce_field('submit_variety','variety_nonce'); ?>
<div id="cwpv-basic" class="cwpv-form-section">
	<p>
        <label>Variety Type: </label>
        <select name="_variety[type]">
            <option value="">Select</option>
            <option value="apple" <?php selected( $this->model->type , 'apple' ); ?> >Apple</option>
        </select>
    </p>
</div>