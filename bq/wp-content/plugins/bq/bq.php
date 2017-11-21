<?php
/*
Plugin Name: BigQ
Plugin URI: /
Description:  anonymous pool
Author: Dragana and Miha
Version: 0.1
Author URI: /
Text Domain: bg
*/
add_action('admin_menu','bigquestion_admin_actions');
function bigquestion_admin_actions(){
    add_menu_page('BigQ','BigQ','manage_options',__FILE__,'bigquestion_admin');
}

function bigquestion_admin()
{
    $st_odgovorov = 2;
    $count = 0;?>
    <form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
        <?php wp_nonce_field('bq'); ?>
        <br/>
        <div  class="wrap">
            <h2 style="background: linear-gradient(to right, black, #0073AA, #8FC2DA); color: white; ">&nbsp;&nbsp;&nbsp;Vnašanje vprašalnika</h2>
            <table class="form-table">
                <tr>
                    <th width="20%">Vprašanje</th>
                    <td width="80%"><input type="text" size="70" name="vprasanje" value="" /></td>
                </tr>
            </table>
            <!-- Odgovori -->
            <h3 style="border-bottom: 2px solid #0073AA; ">Odgovori</h3>
            <table class="form-table">
                <tbody>
                <?php
                for($i = 1; $i <= $st_odgovorov; $i++) {
                    echo "<tr id='odgovor$i'>\n";
                    echo "<th width='20%' > Odgovor";
                    echo $i;
                    echo " </th>\n";
                    echo "<td width='80%'><input type='text' size='57' maxlength='200' name='odgovori[]' />&nbsp;<input type='button' value='Odstrani' onclick='odstrani_odgovor(".$i.");' class='button' /></td>\n";
                    echo "</tr>\n";
                    $count++;
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td width="20%">&nbsp;</td>
                    <td width="80%"><input type="button" value="Dodaj odgovor" onclick="dodaj_odgovor();" class="button" /></td>
                </tr>
                </tfoot>
            </table>

            <!-- Cas trajanja -->
            <h3 style="border-bottom: 2px solid #0073AA;">Čas poteka</h3>
            <table class="form-table">
                <tr>
                    <th width="20%" scope="row" valign="top">Trajane do</th>
                    <td width="80%"><?php poll_timestamp(current_time('timestamp')); ?></td>
                </tr>
            </table>
            <br/>
            <br/>
            <br/>
            <!-- Potrditev oz. preklic ankete -->
            <div align="right" style="width: 60%;">
                <input type="submit" name="send" value="Ustvari" class="button-primary" />&nbsp;&nbsp;
                <input type="button" name="cancel" value="Prekliči" class="button" onclick="javascript:history.go(-1)" />
            </div>
        </div>
    </form>
    <?php
}

/*

*/

/*
 * ACTIONS (Hooks)
 * akcija, ki se zgodi ob določenem času (triggered)
 * določene vgrajene npr. save_post
 * do_action()
 * parametri: $tag (nujno - ime akcije), $args (optional one or more)
 *
 * klicanje akcij:
 * add_action()
 * parametri: $hook (nujno), $function_to_add(nujno), $priority (optional), $accepted_args
 *
 *
 * FILTERS (Hooks)
 * sprejme spremenljivke in jih vrne nazaj spremenjene (za spreminjanje default informacij)
 * ustvarjanje filtra:
 * apply_filters()
 * parametri:
 *      - $tag (nujno) - ime filtra
 *      - $value (nujno) - value oz spremenljivka, ki jo želimo modificirat
 *      - $var (optional) - za dodatne vrednosti, če potrebujemo
 * vgrajeni filtri: the_except, get_the_except()
 *
 * primer, da sam narediš:
 * $name_values = apply_filters('filter_name_array_values', array('Joanna','Peter') );
 *
 * uporaba filtrov:
 * add_filter()
 * parametri:
 *      - $tag (nujno), $function_to_add (nujno), $priority (option), $accepted_args
 *
 * SHORTCODES
 * add_shortcode()
 * - ime in funkcija
 *
 * output_funkcije morejo imet:
 * - attributes, content and name
 *
 * add_shortcode('test_shortcode','my_shortcode_output');
    //perform the shortcode output
    function my_shortcode_output($atts, $content = '', $tag){
    $html = '';
    $html .= '<form name="forma"><label>Vprasanje: <br/> <input type="text"/></label> </form>';
    return $html;

 * v kodi kličemo z [ime_shortcode] npr. ['test_shortcode']
}
 *
*/

?>