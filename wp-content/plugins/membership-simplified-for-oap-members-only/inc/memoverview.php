<div id="oap_inline" style="display:none;">
    <style>
  #TB_ajaxContent{float:left; width:600px!important;height:600px!important;}
      #TB_window{
          background-color: #ffffff !important;
          background-position: left bottom !important;
            background-repeat: repeat-x !important;
            height:600px !important;
      width:650px!important;
      }
      
      .oap-cath2{ 
        background-position: left bottom;
        background-repeat: repeat-x;
        color: #666666;
        padding: 20px;
        width:420px;
          } 
  </style>
    <h4 style="font-family:League;font-size:28px;font-weight:100;margin-bottom:10px;">Create a Membership Overview Page</h4><span class="destext">Use this tool to create an overview section for your membership content. This will allow users to see all of your items for a given program on one page. Each item willl have the title, item number, image and description. Just select the options for your page below.</span>
    <div style="margin:20px;">
      <table width="100%">
        <tr>
          <td valign="top" style="font-family:League;font-size:20px;font-weight:100;margin-bottom:10px;padding-right:10px;">What layout would you like?</td>
          <td>
  <table style="padding-bottom:25px;"><tbody><tr><td style="padding-right:50px;"><img src="http://officeautopilot.com/images/squared.png" /></td><td><img src="http://officeautopilot.com/images/rectangular.png" /></td></tr>
  <tr><td><input type="radio" name="preffered_template" id="preffered_template" value="Squares"/>&nbsp; Squares</td><td><input type="radio" name="preffered_template" id="preffered_template" value="Rectangles"/>&nbsp; Rectangles</td></tr></tbody></table>
    </td>
        </tr>
        <tr>
          <td valign="top" style="font-family:League;font-size:20px;font-weight:100;margin-bottom:10px;padding-right:10px;">What are your lessons called?</td>
          <td style="padding-bottom:25px;"><select name="content_type" id="content_type">
              <option value="Lessons">Lessons</option>
              <option value="Modules">Modules</option>
              <option value="Sections">Sections</option>
            </select>
          
          </td>
        </tr>
        <tr>
          <td valign="top" style="font-family:League;font-size:20px;font-weight:100;margin-bottom:10px;padding-right:10px;">What program would you like to use?</td>
          <td>
  <select class="postform" id="oap_select" name="cat" alt="#TB_inline">
  <option selected="selected" value="0">Select All</option>
  <?php
  
  global $wpdb;
  
  $myrows = $wpdb->get_results( "SELECT term_id FROM $wpdb->term_taxonomy where taxonomy='mprogram'" );
  foreach($myrows as $cat_ids) {
  foreach($cat_ids as $cat_id) {
  $mylink = $wpdb->get_row("SELECT * FROM $wpdb->terms WHERE term_id = '".$cat_id."'");

   ?>
  <option value="<?php echo $mylink->term_id; ?>" class="level-0"><?php echo $mylink->name; ?></option>
  
<?php } } ?>
  </select>
  </td>
        </tr>
      </table>
    </div>
  </div>