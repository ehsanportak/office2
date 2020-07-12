<?php
/*
plugin name:چارت
*/

//show api python

$admin=0;
$k=0;
define('epnm_dir' , plugin_dir_path(__FILE__) );
require_once( epnm_dir . 'post-type.php');
function wporg_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'wporg_dashboard_widget',                          
        esc_html__( 'chart', 'wporg' ), 
        'wporg_dashboard_widget_render'                    
    ); 
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );
function wporg_dashboard_widget_render() {
?>
<?php
$all_posts_args = array(

'post_type' => array('post'),
'posts_per_page' => 9

); 
$all_posts = new WP_Query($all_posts_args);

if($all_posts->have_posts()) :?>

<?php while($all_posts->have_posts()):$all_posts->the_post(); ?>

    <div class="tozihat">
    <?php
    if (get_the_author_ID($all_posts->post->ID)==1){
        $admin+=1;
    }else{
        $k+=1;
    }
    ?>


    </div>

<?php endwhile; ?>
<?php endif; ?>


<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['ادمین', <?php echo $admin ;?> ],
  ['ویرایشگر', <?php echo $k ;?>],
  ['TV', 0],
  ['Gym', 0],
  ['Sleep', 0]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'آمار نویسندگان سایت', 'width':500, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

<?php

}

// add_action('rest_api_init' , function(){
// register_rest_route('wp/v2' , '/author/(?p<id>\d+)' , array(
//     'methods'  => 'GET',
//     'callback' => 'post_of_author'
// ));
// });
// function post_of_author($data){
//     $posts=get_posts(array('author' => $data['id']
// ));
// if(empty($posts))
//     return null;
// else{
//     return $posts;
// }
// }
function wpdocs_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'dashboard_widget', 'api', 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets' );
 
function dashboard_widget_function( $post, $callback_args ) {
    esc_html_e( "", "textdomain" );
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://0.0.0.0:9000/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 60,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$json=json_decode($response);
print_r($err);
print_r($response);

// echo $json[0]->title , '<br>';
// echo $json[0]->author, '<br>';
// echo $json[0]->year_published, '<br>';  


}


?>
