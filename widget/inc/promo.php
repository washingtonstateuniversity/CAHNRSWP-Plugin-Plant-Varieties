<li class="promo tab-content-wrapper">
	<a href="#" class="lightbox-action">
    	<img src="http://treefruitdev.topics.wpdev.cahnrs.wsu.edu/wp-content/uploads/sites/5/2014/11/<?php echo $data['img'];?>" width="150"  />
    </a>
	<a href="#" class="title lightbox-action">
    	 <span><?php echo $name;?></span>
    </a>
    <div class="lightbox-content" data-type="html-content" style="display: none">
    	<div class="align-left"> 
    		<img src="http://treefruitdev.topics.wpdev.cahnrs.wsu.edu/wp-content/uploads/sites/5/2014/11/<?php echo $data['img'];?>" width="250"  /> 
        </div>
        <table class="variety-data">
        	<tbody>
            	<tr>
                	<td class="variety-title" colspan="2">
                    	<?php echo $name;?>
                    </td>
                </tr>
            	<tr>
                	<td class="label">
                    	Parentage:
                    </td>
                    <td class="data">
                    	<?php echo $data['par'];?>
                    </td>
                </tr>
                <tr>
                	<td class="label">
                    	Origin:
                    </td>
                    <td class="data">
                    	<?php echo $data['or'];?>
                    </td>
                </tr>
                <tr>
                	<td class="label">
                    	IP&nbsp;Status:
                    </td>
                    <td class="data">
                    	<?php echo $data['ip'];?>
                    </td>
                </tr>
                <tr>
                	<td class="label">
                    	Color:
                    </td>
                    <td class="data">
                    	<?php echo $data['col'];?>
                    </td>
                </tr>
                <tr>
                	<td class="label">
                    	Flavor&nbsp;Profile:
                    </td>
                    <td class="data">
                    	<?php echo $data['flav'];?>
                    </td>
                </tr>
                <tr>
                	<td class="label">
                    	Storability:
                    </td>
                    <td class="data">
                    	<?php echo $data['stor'];?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="clear: both;"></div>
    </div>
</li>