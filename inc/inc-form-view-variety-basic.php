<?php wp_nonce_field('submit_variety','variety_nonce'); ?>
<div id="cwpv-basic" class="cwpv-form-section">
	<p>
        <label>Variety Type: </label>
        <select name="_variety[type]">
            <option value="">Select</option>
            <option value="apple" <?php selected( $variety['type'] , 'apple' ); ?> >Apple</option>
            <option value="pear" <?php selected( $variety['type'] , 'pear' ); ?> >Pear</option>
            <option value="cherry" <?php selected( $variety['type'] , 'cherry' ); ?> >Cherry</option>
        </select>
    </p>
</div>