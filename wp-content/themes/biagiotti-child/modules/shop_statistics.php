<?php
add_action( 'admin_menu', 'orders_statistics_page', 25 );
 
function orders_statistics_page(){
 
	add_submenu_page(
		'woocommerce-marketing',
		__('Статистика заказов', 'biagiotti-child'),
		__('Статистика заказов', 'biagiotti-child'),
		'manage_options',
		'orders_statistics',
		'orders_statistics_page_callback'
	);

}
 
function orders_statistics_page_callback(){
global $wpdb;
  
  $current_time = time();
  $last_year_time = $current_time-365*24*60*60;
  
  $total_border1 = 5000;
  $total_border2 = 10000;

  $completed_orders = wc_get_orders( array(
      'status' => 'completed',
      'limit' => -1,
      'return' => 'objects',
  ) );
  
  $phones = array();
  foreach ($completed_orders as $item)
  {
    $data = $item->data;
  
    if (isset($data['billing']['email']) && $data['billing']['email']!='' && $data['currency']=='UAH')
    {
      $phone = $data['billing']['email'];
      if (!isset($phones[$phone])) $phones[$phone] = array('total'=>0, 'total_last_year'=>0, 'min_order_time'=>$current_time);
      
      $time = (isset($data['date_completed']) && !is_null($data['date_completed'])) ? $data['date_completed']->getTimestamp() : $current_time;
      
      $phones[$phone]['total'] += $data['total'];
      if ($time>=$last_year_time) $phones[$phone]['total_last_year'] += $data['total'];
      if ($time<$phones[$phone]['min_order_time']) $phones[$phone]['min_order_time'] = $time;
    }
  }
  
  ksort($phones);
?>
		<div class="wrap orders_statistics-settings-page">
			<h1><?php esc_html_e('Статистика заказов', 'biagiotti-child'); ?></h1>
      <table>
      <tr>
        <th><?php esc_html_e('Email', 'biagiotti-child'); ?></th>
        <th><?php esc_html_e('Всего куплено', 'biagiotti-child'); ?></th>
        <th><?php esc_html_e('Куплено за последний год', 'biagiotti-child'); ?></th>
        <th><?php esc_html_e('Среднегодовые покупки', 'biagiotti-child'); ?></th>
      </tr>
<?php  
  foreach ($phones as $phone=>$values)
  {
    $time_delta = $current_time - $values['min_order_time'];
    $days = $time_delta / (24*60*60);
    if ($days<365) $days = 365;
    $years = $days / 365; 
    
    $phones[$phone]['year_average'] = $values['total'] / $years;
    
    $total_class = 'orders_statistics_summ';
    if ($phones[$phone]['total']>=$total_border1) $total_class = 'orders_statistics_summ_border1';
    if ($phones[$phone]['total']>=$total_border2) $total_class = 'orders_statistics_summ_border2';
    $total_last_year_class = 'orders_statistics_summ';
    if ($phones[$phone]['total_last_year']>=$total_border1) $total_last_year_class = 'orders_statistics_summ_border1';
    if ($phones[$phone]['total_last_year']>=$total_border2) $total_last_year_class = 'orders_statistics_summ_border2';
    $year_average_class = 'orders_statistics_summ';
    if ($phones[$phone]['year_average']>=$total_border1) $year_average_class = 'orders_statistics_summ_border1';
    if ($phones[$phone]['year_average']>=$total_border2) $year_average_class = 'orders_statistics_summ_border2';
?>
      <tr>
        <th><?=$phone; ?></th>
        <th class="<?=$total_class; ?>"><? echo number_format($phones[$phone]['total'], 2, '.', '&nbsp;'); ?></th>
        <th class="<?=$total_last_year_class; ?>"><? echo number_format($phones[$phone]['total_last_year'], 2, '.', '&nbsp;'); ?></th>
        <th class="<?=$year_average_class; ?>"><? echo number_format($phones[$phone]['year_average'], 2, '.', '&nbsp;'); ?></th>
      </tr>
<?php  
  }
?>
      </table>
		</div>
<?php
}