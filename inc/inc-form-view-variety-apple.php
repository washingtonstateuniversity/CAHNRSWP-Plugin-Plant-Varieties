<?php wp_nonce_field('submit_variety','variety_nonce'); ?>
<div id="cwpv-apple" class="cwpv-form-section">
	<p class="inline-half" >
        <label>Harvest Time: </label><br />
        <select name="_variety[harvest]">
            <option value="">Select</option>
            <option value="early" <?php selected( $this->model->harvest , 'early' ); ?> >Early</option>
            <option value="midseason" <?php selected( $this->model->harvest , 'midseason' ); ?> >Midseason</option>
            <option value="late" <?php selected( $this->model->harvest , 'late' ); ?> >Late</option>
        </select>
    </p><p class="inline-half" >
        <label>Parentage: </label><br />
        <input type="text" name="_variety[parentage]" value="<?php echo $this->model->parentage;?>" /><br />
        <span class="helper-text">Seperate multiple values with ",".</span>
    </p><p class="inline-half" >
        <label>Origin City or State:</label><br />
        <input type="text" name="_variety[origin]" value="<?php echo $this->model->origin;?>" /><br />
        <span class="helper-text">Seperate multiple values with ",".</span>
    </p><p class="inline-half" >
        <label>Origin Country:</label><br />
        <input type="text" name="_variety[origin_country]" value="<?php echo $this->model->origin_country;?>" /><br />
        <span class="helper-text">Seperate multiple values with ",".</span>
    </p><p class="inline-half" >
        <label>Origin Year:</label><br />
        <input type="text" name="_variety[origin_year]" value="<?php echo $this->model->origin_year;?>" /><br />
        <span class="helper-text">Seperate multiple values with ",".</span>
    </p><p class="inline-half" >
        <label>IP Status:</label><br />
        <input type="text" name="_variety[IP]" value="<?php echo $this->model->IP;?>" /><br />
        <span class="helper-text">Seperate multiple values with ",".</span>
    </p><p class="inline-half" >
        <label>Color:</label><br />
        <textarea name="_variety[color]"><?php echo $this->model->color;?></textarea>
    </p><p class="inline-half" >
        <label>Flavor Profile:</label><br />
        <input type="text" name="_variety[flavor_profile]" value="<?php echo $this->model->flavor_profile;?>" /><br />
        <span class="helper-text">Seperate multiple values with ",".</span>
    </p><p class="inline-half" >
        <label>Storage Time</label><br />
        <select name="_variety[storability]">
        	<option value="two months" <?php selected( $this->model->storability , 'two months' ); ?> >2 Months</option>
            <option value="three months" <?php selected( $this->model->storability , 'three months' ); ?> >3 Months</option>
            <option value="four months" <?php selected( $this->model->storability , 'four months' ); ?> >4 Months</option>
            <option value="five months" <?php selected( $this->model->storability , 'five months' ); ?> >5 Months</option>
            <option value="six months" <?php selected( $this->model->storability , 'six months' ); ?> >6 Months</option>
            <option value="seven months" <?php selected( $this->model->storability , 'seven months' ); ?> >7 Months</option>
            <option value="eight months" <?php selected( $this->model->storability , 'eight months' ); ?> >8 Months</option>
            <option value="nine months" <?php selected( $this->model->storability , 'nine months' ); ?> >9 Months</option>
            <option value="ten months" <?php selected( $this->model->storability , 'ten months' ); ?> >10 Months</option>
            <option value="eleven months" <?php selected( $this->model->storability , 'eleven months' ); ?> >11 Months</option>
            <option value="twelve months" <?php selected( $this->model->storability , 'twelve months' ); ?> >12 Months</option>
            <option value="thriteen months" <?php selected( $this->model->storability , 'thriteen months' ); ?> >13 Months</option>
		</select>
    </p>
</div>