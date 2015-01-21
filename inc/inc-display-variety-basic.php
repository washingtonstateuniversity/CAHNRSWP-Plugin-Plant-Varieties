<div class="variety-data-wrapper">
	<div class="variety-image" style="width: 30%; display: inline-block; vertical-align: top; margin-right: 1%;">
    	<?php if ( has_post_thumbnail() ) :?>
        
        <?php the_post_thumbnail( 'medium' ); ?>
        
        <?php endif;?> 
        
    </div><div class="variety-data" style="width: 67%; display: inline-block; vertical-align: top;">
        <table>
        	<tbody>
				<?php if ( isset( $this->model->parentage ) && $this->model->parentage ) :?>
            	<tr>
                	<td class="label">
                    	Parentage:
                    </td>
                    <td class="data">
                    	<?php echo ucfirst( $this->model->parentage ); ?>
                    </td>
                </tr>
                <?php endif;?>
                <?php if ( isset( $this->model->origin_country ) && $this->model->origin_country ) :?>
            	<tr>
                	<td class="label">
                    	Origin:
                    </td>
                    <td class="data">
                    	<?php echo $this->model->origin; ?>, <?php echo $this->model->origin_country; ?>, <?php echo $this->model->origin_year; ?>
                    </td>
                </tr>
                <?php endif;?>
                <?php if ( isset( $this->model->IP ) && $this->model->IP ) :?>
            	<tr>
                	<td class="label">
                    	IP&nbsp;Status:
                    </td>
                    <td class="data">
                    	<?php echo ucfirst( $this->model->IP ); ?>
                    </td>
                </tr>
                <?php endif;?>
                <?php if ( isset( $this->model->color ) && $this->model->color ) :?>
            	<tr>
                	<td class="label">
                    	Color:
                    </td>
                    <td class="data">
                    	<?php echo ucfirst( $this->model->color ); ?>
                    </td>
                </tr>
                <?php endif;?>
                <?php if ( isset( $this->model->flavor_profile ) && $this->model->flavor_profile ) :?>
            	<tr>
                	<td class="label">
                    	Flavor&nbsp;Profile:
                    </td>
                    <td class="data">
                    	<?php echo ucfirst( $this->model->flavor_profile ); ?>
                    </td>
                </tr>
                <?php endif;?>
                 <?php if ( isset( $this->model->storability ) && $this->model->storability ) :?>
            	<tr>
                	<td class="label">
                    	Storage&nbsp;Duration:
                    </td>
                    <td class="data">
                    	<?php echo ucfirst( $this->model->storability ); ?>
                    </td>
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        </div>
</div>
<?php if ( isset( $this->model->summary ) && $this->model->summary ): ?>
<div class="variety-content">
    
    <?php echo $this->model->summary; ?>
    
</div><?php endif; ?>