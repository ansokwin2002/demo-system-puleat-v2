<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        oTable = $('#NTTable').dataTable({
            "aaSorting": [[1, "asc"], [2, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('notifications/getNotifications') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [null, {"mRender": fld}, {"mRender": fld}, {"mRender": fld}, {"bSortable": false}]
        });
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-info-circle"></i><?= lang('notifications'); ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown"><a href="<?= admin_url('notifications/add'); ?>" data-toggle="modal"
                                        data-target="#myModal"><i class="icon fa fa-plus"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('list_results'); ?></p>

                <div class="table-responsive">
                    <table id="NTTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th><?php echo $this->lang->line("notification"); ?></th>
                            <th style="width: 140px;"><?php echo $this->lang->line("submitted_at"); ?></th>
                            <th style="width: 140px;"><?php echo $this->lang->line("from"); ?></th>
                            <th style="width: 140px;"><?php echo $this->lang->line("till"); ?></th>
                            <th style="width:80px;"><?php echo $this->lang->line("actions"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="5" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <!--<p><a href="<?php echo admin_url('notifications/add'); ?>" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line("add_notification"); ?></a></p>-->
            </div>
        </div>
    </div>
</div>

<?php

//need sma_product_discount_inv2016, sma_companies_inv2016
//add temp_email to sma_product_discount_inv2016

// $temp = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_product_discount_inv2016"
//     ,"id > 0"
//     ,"arr"
// );
// $temp2 = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_products"
//     ,"id > 0"
//     ,"arr"
// );
// for ($i=0;$i<count($temp);$i++) {
//     $b = 0;
//     for ($i2=0;$i2<count($temp2);$i2++) {
//         if ($temp[$i]['product_code'] == $temp2[$i2]['code']) {
//             $temp3 = array(
//                 'product_id' => $temp2[$i2]['id']
//             );            
//             $this->db->update('sma_product_discount_inv2016', $temp3,'id = '.$temp[$i]['id']);
//         }        
//     }
// }

// $temp = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_product_discount_inv2016"
//     ,"id > 0"
//     ,"arr"
// );
// $temp2 = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_companies_inv2016"
//     ,"id > 0"
//     ,"arr"
// );
// for ($i=0;$i<count($temp);$i++) {
//     $b = 0;
//     for ($i2=0;$i2<count($temp2);$i2++) {
//         if ($temp[$i]['customer_id'] == $temp2[$i2]['id']) {
//             $temp3 = array(
//                 'temp_email' => $temp2[$i2]['email']
//             );            
//             $this->db->update('sma_product_discount_inv2016', $temp3,'id = '.$temp[$i]['id']);
//         }        
//     }
// }


// $temp = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_product_discount_inv2016"
//     ,"id > 0"
//     ,"arr"
// );
// $temp2 = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_companies"
//     ,"id > 0"
//     ,"arr"
// );
// for ($i=0;$i<count($temp);$i++) {
//     $b = 0;
//     for ($i2=0;$i2<count($temp2);$i2++) {
//         if ($temp[$i]['temp_email'] == $temp2[$i2]['email']) {
//             $temp3 = array(
//                 'customer_id' => $temp2[$i2]['id']
//             );            
//             $this->db->update('sma_product_discount_inv2016', $temp3,'id = '.$temp[$i]['id']);
//         }        
//     }
// }



// $date = date('Y-m-d');
// $temp2 = $this->site->api_select_some_fields_with_where("
//     *     
//     "
//     ,"sma_product_discount_inv2016"
//     ,"id > 0 and start_date <= '".$date."' and end_date >= '".$date."'"
//     ,"arr"
// );
// for ($i=0;$i<count($temp2);$i++) {
//     $temp3 = array();
//     foreach ($temp2[$i] as $key => $value) {
//         if ($key != 'id' && $key != 'temp_email')
//             $temp3[$key] = $value;
//     }
//     $this->db->insert('sma_product_discount', $temp3);
// }

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);

// for ($i=0;$i<count($select_data);$i++) {
//     $temp = 'en:{'.$select_data[$i]['name'].'}:kh:{'.$select_data[$i]['name'].'}:ja:{'.$select_data[$i]['name'].'}:ch:{'.$select_data[$i]['name'].'}:';

//     $temp_update_2 = array(
//         'translate' => $temp,
//     );
//     $this->db->update('sma_products', $temp_update_2,"id = ".$select_data[$i]['id']);
// }

//stock 0
// $temp_update_2 = array(
//     'quantity' => 0,
// );
// $this->db->update('sma_warehouses_products', $temp_update_2,"warehouse_id = 3 or warehouse_id = 4");

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $config_data = array(
//         'table_name' => 'sma_products',
//         'id_name' => 'id',
//         'field_add_ons_name' => 'add_ons',
//         'selected_id' => $select_data[$i]['id'],
//         'add_ons_title' => 'quantity_3',
//         'add_ons_value' => 0,                    
//     );
//     $this->site->api_update_translate_field($config_data); 

//     $config_data = array(
//         'table_name' => 'sma_products',
//         'id_name' => 'id',
//         'field_add_ons_name' => 'add_ons',
//         'selected_id' => $select_data[$i]['id'],
//         'add_ons_title' => 'quantity_4',
//         'add_ons_value' => 0,                    
//     );
//     $this->site->api_update_translate_field($config_data); 
// }


// No Vat customer sales -> Vat Sales
// $config_data = array(
//     'table_name' => 'sma_sales',
//     'select_table' => 'sma_sales',
//     'translate' => '',
//     'select_condition' => "customer_id = 529 and (date BETWEEN '2020-10-01 00:00:00' AND '2020-10-30 00:00:00')",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {

//     $temp = array(
//         'customer' => 'SONATRA GRAND FOODS CO.,LTD',
//         'customer_id' => 1388,
//     );
//     $this->db->update('sma_sales', $temp,"id = ".$select_data[$i]['id']);
// }

// $config_data = array(
//     'table_name' => 'sma_categories_bk',
//     'select_table' => 'sma_categories_bk',
//     'translate' => '',
//     'select_condition' => "id > 0 order by id asc",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $temp = array(
//         'id' => $select_data[$i]['id'],
//         'translate' => $select_data[$i]['translate'],
//         'code' => $select_data[$i]['code'],
//         'image' => $select_data[$i]['image'],
//         'parent_id' => $select_data[$i]['parent_id'],
//         'slug' => $select_data[$i]['slug'],
//         'add_ons' => $select_data[$i]['add_ons'],
//     );
//     $this->db->insert('sma_categories', $temp);    
// }




// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $config_data = array(
//         'table_name' => 'sma_products',
//         'id_name' => 'id',
//         'field_add_ons_name' => 'add_ons',
//         'selected_id' => $select_data[$i]['id'],
//         'add_ons_title' => 'business_use',
//         'add_ons_value' => 'yes',                    
//     );
//     $this->site->api_update_add_ons_field($config_data); 
// }

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $temp = '';
//     $temp .= $select_data[$i]['category_id'].'-';
//     $temp .= $select_data[$i]['subcategory_id'].'-';
//     $temp2 = array(
//         'c_id' => $temp,
//     );
//     $this->db->update('sma_products', $temp2, "id = ".$select_data[$i]['id']);
// }

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $temp2 = array(
//         'category_id' => '',
//         'subcategory_id' => '',
//     );
//     $this->db->update('sma_products', $temp2, "id = ".$select_data[$i]['id']);
// }





// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     if ($select_data[$i]['no_use'] != 'yes') {
//         $config_data = array(
//             'table_name' => 'sma_products',
//             'id_name' => 'id',
//             'field_add_ons_name' => 'add_ons',
//             'selected_id' => $select_data[$i]['id'],
//             'add_ons_title' => 'no_use',
//             'add_ons_value' => '',                    
//         );
//         $this->site->api_update_add_ons_field($config_data);   
//     }
// }

// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     if ($select_data[$i]['closed'] != 'yes') {
//         $config_data = array(
//             'table_name' => 'sma_companies',
//             'id_name' => 'id',
//             'field_add_ons_name' => 'add_ons',
//             'selected_id' => $select_data[$i]['id'],
//             'add_ons_title' => 'closed',
//             'add_ons_value' => '',                    
//         );
//         $this->site->api_update_add_ons_field($config_data);   
//     }
// }

// $temp = array(
//     'add_ons' => 'initial_first_add_ons:{}:cs_reference_no:{}:',
// );
// $this->db->update('sma_sales', $temp,"add_ons IS NULL");  





// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);

// for ($i=0;$i<count($select_data);$i++) {
//     $select_data[$i]['city'] = trim($select_data[$i]['city']);
//     $temp = array(
//         'city' => $select_data[$i]['city'],
//     );
//     $this->db->update('sma_companies', $temp, "id = ".$select_data[$i]['id']);
// }


// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);

// for ($i=0;$i<count($select_data);$i++) {
//     $select_data[$i]['city'] = trim($select_data[$i]['city']);
//     $temp = array(
//         'city_id' => 75,
//     );
//     $this->db->update('sma_companies', $temp, "id = ".$select_data[$i]['id']);
// }




// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'select_condition' => "id > 0 and add_ons like '%:closed:{}:%'",
// );
// $select_data = $this->site->api_select_data_v2($config_data);

// for ($i=0;$i<count($select_data);$i++) {
//     if ($select_data[$i]['customer_group_id'] > 0) {
//         $config_data = array(
//             'table_name' => 'sma_customer_groups',
//             'select_table' => 'sma_customer_groups',
//             'translate' => '',
//             'select_condition' => "id = ".$select_data[$i]['customer_group_id'],
//         );
//         $temp = $this->site->api_select_data_v2($config_data);
//         if (count($temp) <= 0 || $select_data[$i]['customer_group_id'] == 1) {
//             $j = $i + 1;
//             echo $j.':<br>'.$select_data[$i]['company'].' (Name: '.$select_data[$i]['name'].')<br><br>';
//         }
//     }
// }


// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {

//     if ($select_data[$i]['no_use'] == '') {
//         $config_data = array(
//             'table_name' => 'sma_products',
//             'id_name' => 'id',
//             'field_add_ons_name' => 'add_ons',
//             'selected_id' => $select_data[$i]['id'],
//             'add_ons_title' => 'no_use',
//             'add_ons_value' => '',                    
//         );
//         $this->site->api_update_add_ons_field($config_data); 
//     }
// }

// $config_data = array(
//     'add_ons_table_name' => 'sma_add_ons',
//     'table_name' => 'sma_products',
// );
// $this->api_helper->api_add_ons_set_null($config_data);

//$this->sma->print_arrays($temp_field['condition']);



// $config_data = array(
//     'table_name' => 'sma_sale_summary_vat',
//     'select_table' => 'sma_sale_summary_vat',
//     'translate' => '',
//     'select_condition' => "start_date = '2021-06-01' and end_date = '2021-06-30'",
// );
// $select_data = $this->site->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $temp = array(
//         'date' => '2021-06-30 00:00:00',
//     );
//     $this->db->update('sma_sale_summary_vat', $temp,"id = ".$select_data[$i]['id']);
// }

// $temp = $this->site->api_select_some_fields_with_where("
//     *     
//     "
//     ,"sma_sales"
//     ,"id > 0 and date >= '2021-07-01 00:00:00' and date <= '2021-07-31 23:59:59'"
//     ,"arr"
// );
// $temp3 = 0;
// for ($i=0;$i<count($temp);$i++) {
    
//     $temp2 = $this->site->api_select_some_fields_with_where("
//         *     
//         "
//         ,"sma_sale_items"
//         ,"sale_id = ".$temp[$i]['id']." and product_id = 5721"
//         ,"arr"
//     );
    
//     for ($i2=0;$i2<count($temp2);$i2++) {
//         echo $temp2[$i2]['id'].'=';
//         $temp3 += $temp2[$i2]['quantity'];
//     }
// }
// echo $temp3;








// $temp = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_products"
//     ,"promo_price > 0"
//     ,"arr"
// );
// for ($i=0;$i<count($temp);$i++) {
//     $temp_2 = ($temp[$i]['promo_price'] * 100) / $temp[$i]['price'];
//     $temp_3 = $this->api_helper->number_format($temp_2,2);
//     $config_data = array(
//         'table_name' => 'sma_products',
//         'id_name' => 'id',
//         'field_add_ons_name' => 'add_ons',
//         'selected_id' => $temp[$i]['id'],
//         'add_ons_title' => 'promotion_rate',
//         'add_ons_value' => $temp_3,                    
//     );
//     $this->site->api_update_add_ons_field($config_data);         
// }

// $temp = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_product_discount"
//     ,"id > 0"
//     ,"arr"
// );
// for ($i=0;$i<count($temp);$i++) {
//     $temp_2 = $this->site->api_select_some_fields_with_where("
//         price
//         "
//         ,"sma_products"
//         ,"id = ".$temp[$i]['product_id']
//         ,"arr"
//     );
//     $temp_3 = $this->api_helper->get_rate_by_amount($temp[$i]['special_price'],$temp_2[0]['price']);

//     $temp_4 = array(
//         'discount_price' => $temp_3['rate_discount'],
//     );
//     $this->db->update('sma_product_discount', $temp_4,"id = ".$temp[$i]['id']);
// }

// $temp = $this->site->api_select_some_fields_with_where("
//     *
//     "
//     ,"sma_products"
//     ,"id > 0"
//     ,"arr"
// );
// for ($i=0;$i<count($temp);$i++) {
//     $temp_2 = explode('-',$temp[$i]['c_id']);
//     $temp_2 = array_unique($temp_2);
//     $temp_3 = '';
//     for ($i2=0;$i2<count($temp_2);$i2++) {
//         if ($temp_2[$i2] != '')
//             $temp_3 .= '-'.$temp_2[$i2].'-';
//     }
//     $config_data = array(
//         'c_id' => $temp_3,
//     );
//     $this->db->update('sma_products',$config_data,"id = ".$temp[$i]['id']);         
// }


// $config_data = array(
//     'add_ons_table_name' => 'sma_add_ons',
//     'table_name' => 'sma_categories',
//     'condition' => "id > 0",
// );
// $this->api_helper->fix_add_ons_value($config_data);




//$temp_customer = $this->api_cache->get_customer_admin();
//$this->api_helper->print_array($temp);

//$select_customer_group = $this->api_cache->get_customer_group_admin();
//$this->api_helper->print_array($temp);

// $k=1;
// for ($i4=0;$i4<count($temp_customer);$i4++) {
//     $b = 0;
//     foreach ($select_customer_group as $key => $value) {
//         if ($temp_customer[$i4]['customer_group_id'] == $key) {
//             $b = 1;
//             break;
//         }
//     }    
//     if ($b == 0) {
//         echo $k.'. '.$temp_customer[$i4]['company'].' (Name: '.$temp_customer[$i4]['name'].')<br><br>';
//         $k++;
//     }
// }

// $config_data = array(
//     'table_name' => 'sma_customer_groups',
//     'select_table' => 'sma_customer_groups',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0",
// );
// $select_customer_group = $this->api_helper->api_select_data_v2($config_data);
// $k=1;
// for ($i4=0;$i4<count($temp_customer);$i4++) {
//     $b = 0;
//     $temp = array();
//     for ($i5=0;$i5<count($select_customer_group);$i5++) {
//         if ($temp_customer[$i4]['customer_group_id'] == $select_customer_group[$i5]['id']) {
//             $b = 1;
//             $temp = $select_customer_group[$i5];
//             break;
//         }
//     }    
//     if ($b == 1) {
//         $b2 = 0;
//         if ($temp['parent_id'] == 0) {
//             $temp_2 = $this->api_helper->api_select_some_fields_with_where("
//                 id
//                 "
//                 ,"sma_customer_groups"
//                 ,"parent_id = ".$temp['id']." limit 1"
//                 ,"arr"
//             );
//             if (count($temp_2) > 0)
//                 $b2 = 1;
//         }

//         if ($b2 == 1) {
//             echo $k.'. '.$temp_customer[$i4]['company'].' (Name: '.$temp_customer[$i4]['name'].')<br><br>';
//             $k++;
//         }
//     }
// }


// $config_data = array(
//     'table_name' => 'sma_sales',
//     'select_table' => 'sma_sales',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "date like '%2021-01-%' and sale_status = 'completed'",
// );
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// $temp_2 = 0;
// for ($i=0;$i<count($select_data);$i++) {
//     $config_data = array(
//         'table_name' => 'sma_sale_items',
//         'select_table' => 'sma_sale_items',
//         'translate' => '',
//         'description' => '',
//         'select_condition' => "sale_id = ".$select_data[$i]['id']." and product_id = 5047",
//     );
//     $temp = $this->api_helper->api_select_data_v2($config_data);
//     for ($i2=0;$i2<count($temp);$i2++) {
//         $temp_2 += $temp[$i2]['quantity'];
//     }
// }
// echo $temp_2;


// $config_data = array(
//     'table_name' => 'sma_consignment',
//     'select_table' => 'sma_consignment',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "sale_status = 'delivered'",
// );
// $temp = $this->api_helper->api_select_data_v2($config_data);
// for ($i=0;$i<count($temp);$i++) {
//     $config_data = array(
//         'id' => $temp[$i]['id'],
//         'reference_no' => $temp[$i]['reference_no'],
//     );
//     $api_get_consignment_qty = $this->site->api_get_consignment_qty($config_data);
//     if ($api_get_consignment_qty['sold_qty'] > 0) {
//         $temp2 = array(
//             'sale_status' => 'consigning'
//         );
//         $this->db->update('sma_consignment', $temp2,"id = ".$id);
//     }
// }
//echo $this->site->api_calulate_plt_amount(302.5000);




// $config_data = array(
//     'table_name' => 'sma_sales',
//     'select_table' => 'sma_sales',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id = 166663",
// );
// //or id = 166658
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
    
//     $temp = array();
//     foreach ($select_data[$i] as $key => $value) {
//         if ($key != 'id')
//             $temp[$key] = $value;
//         else
//             $temp[$key] = 1;
//     }
//     //$this->api_helper->print_array($temp);
//     if (!$this->db->insert('sma_sales', $sale_data))
//         echo 'Failed<br>';
//     else
//         echo 'Success<br>';
// }


// $select_customer = $this->api_cache->get_customer_admin();
// echo count($select_customer);

// $temp_array = array();
// for ($i=0;$i<count($select_customer);$i++) {
//     $config_data = array(
//         'id' => $select_customer[$i]['id'],
//     );
//     $temp = $this->api_helper->check_customer_status($config_data);
//     if ($temp['status'] == 'red')
//         $temp_array[] = $select_customer[$i];
// }

// for ($i=0;$i<count($temp_array);$i++) {
//     echo $temp_array[$i]['company'].' (Name: '.$temp_array[$i]['name'].')<br>';
// }

// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);

// for ($i=0;$i<count($select_data);$i++) {
//     $temp = array(
//         'add_ons' => $select_data[$i]['add_ons'].'customer_potential:{}:',
//     );
//     $this->db->update('sma_companies', $temp, "id = ".$select_data[$i]['id']);
// }

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->site->api_select_data_v2($config_data);

// for ($i=0;$i<count($select_data);$i++) {
//     $temp = array(
//         'add_ons' => $select_data[$i]['add_ons'].'product_potential:{}:',
//     );
//     $this->db->update('sma_products', $temp, "id = ".$select_data[$i]['id']);
// }



// $temp = array(
//     'table_name' => 'sma_quotes',
//     'add_ons' => 'initial_first_add_ons:{}:retail_team_quote:{}:'
// );
// $this->db->insert('sma_add_ons', $temp);


//$this->db->query("ALTER TABLE sma_quotes ADD add_ons TEXT NULL");

// $temp = $this->api_helper->api_select_some_fields_with_where("
//     version
//     "
//     ,"sma_shop_settings"
//     ,"shop_id = 1"
//     ,"arr"
// );
// echo $temp[0]['version'];

// $temp = array(
//     'version' => 50,
// );
// $this->db->update('sma_shop_settings', $temp, "shop_id = 1");

// if ($this->sma->send_email('apipeapi@gmail.com', 'test', 'hello', 'order@daishintc.com', null, $attachment, $cc, $bcc)) {
//     echo 'success';
// }
// else
//     echo 'error';


// $temp = $this->api_helper->api_select_some_fields_with_where("
//     id
//     "
//     ,"sma_sales"
//     ,"date like '%2022-01-%'"
//     ,"arr"
// );
// echo count($temp);

// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0 order by id asc",
// );
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     if ($select_data[$i]['payment_due_date'] != '') {
//         $temp_date = date_create($select_data[$i]['payment_due_date']);
//         $config_data = array(
//             'table_name' => 'sma_companies',
//             'id_name' => 'id',
//             'field_add_ons_name' => 'add_ons',
//             'selected_id' => $select_data[$i]['id'],
//             'add_ons_title' => 'payment_due_date',
//             'add_ons_value' => date_format($temp_date,'d'),
//         );
//         $this->site->api_update_add_ons_field($config_data);
//     }
// }

// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0 order by id asc",
// );
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     if ($select_data[$i]['payment_due_date'] != '') {
//         //echo $select_data[$i]['payment_due_date'].'<br>';
//         $temp = intval($select_data[$i]['payment_due_date']);
//         $config_data = array(
//             'table_name' => 'sma_companies',
//             'id_name' => 'id',
//             'field_add_ons_name' => 'add_ons',
//             'selected_id' => $select_data[$i]['id'],
//             'add_ons_title' => 'payment_due_date',
//             'add_ons_value' => $temp,
//         );
//         $this->site->api_update_add_ons_field($config_data);
//     }
// }
//echo realpath('').'\data.json';

// $temp = array(
//     'add_ons' => 'initial_first_add_ons:{}:discount_product:{}:vat_invoice_type:{}:sale_consignment_auto_insert:{}:closed:{}:favorite:{}:plt:{}:rebate:{}:price_decimal:{}:national_id:{}:passport_id:{}:opening_date:{}:birth_day:{}:payment_due_date:{}:birthday_owner:{}:birthday_manger:{}:currency:{}:trade_condition:{}:total_cost:{}:transportation_method:{}:payment_term:{}:lead_time:{}:payment_term_option:{}:lead_time_option:{}:no_display_postal_code:{}:no_display_cambodia:{}:no_display_city:{}:register_purchase_contact_info_phone:{}:register_purchase_contact_info_name:{}:register_check_order_and_delivery:{}:register_check_refund:{}:register_check_payment:{}:register_other_info:{}:register_restaurant_name:{}:register_bank:{}:register_bank_number:{}:register_bank_account_name:{}:register_financial_contact_info_name:{}:register_financial_contact_phone_number:{}:patent_file:{}:plt_include_vat:{}:customer_potential:{}:summary_due_date:{}:kh_currency_rate_type:{}:',
// );
// $this->db->update('sma_add_ons', $temp,"table_name = 'sma_companies'");

// $config_data = array(
//     'table_name' => 'sma_currencies',
//     'select_table' => 'sma_currencies',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0",
// );
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// for ($i=0;$i<count($select_data);$i++) {
//     $config_data = array(
//         'table_name' => 'sma_currencies',
//         'id_name' => 'id',
//         'field_add_ons_name' => 'add_ons',
//         'selected_id' => $select_data[$i]['id'],
//         'add_ons_title' => 'rate_tax',
//         'add_ons_value' => $select_data[$i]['rate'],
//     );
//     $this->site->api_update_add_ons_field($config_data);
// }

// $temp = '
// -184678-185084-185121-185231-185313-185349-185363-185368-185414-185709-185808-185841-185912-186022-186036-186106-186247-186250-186255-186480-186352-186353-186662-186754-186761-186897-187083-187176-187241-187272-187360-187499-187511-187849-188124-188061
// ';
// $temp_sale = explode('-',$temp);
// $temp = array();
// $k = 0;
// for ($i=1;$i<count($temp_sale);$i++) {
//     if ($temp_sale[$i] != '') {
//         $temp[$k]['id'] = $temp_sale[$i];
//         $k++;
//         $config_data = array(
//             'table_name' => 'sma_sales',
//             'select_table' => 'sma_sales',
//             'translate' => '',
//             'description' => '',
//             'select_condition' => "id = ".$temp_sale[$i],
//         );
//         $select_data = $this->api_helper->api_select_data_v2($config_data);
//         echo $select_data[0]['total_discount'].'='.$temp_sale[$i].'<br>';
//     }
// }

// $condition = 'and (sale_id = '.$temp[0]['id'];
// for ($i=1;$i<count($temp);$i++) {
//     if ($temp[$i]['id'] != '') {
//         $condition .= ' or sale_id = '.$temp[$i]['id'];
//     }
// }
// $condition .= ')';

// $config_data = array(
//     'table_name' => 'sma_sale_items',
//     'select_table' => 'sma_sale_items',
//     'select_condition' => "id > 0 ".$condition,
// );
// $temp3 = $this->site->api_select_data_v2($config_data);

// $temp4 = array();
// $temp5 = $this->site->api_select_some_fields_with_where("*                
//     "
//     ,"sma_sale_items"
//     ,"id > 0 ".$condition
//     ,"arr"
// );

// if (is_array($temp5))
// for ($i=0;$i<count($temp5);$i++) {
//     $temp4[$i] = $temp5[$i]['product_id'].'_'.$temp5[$i]['unit_price'];
// }
            
// $temp4 = array_unique($temp4);         

// $temp2 = array();
// $j = 0;
// foreach ($temp4 as $value) {                                                
//     for ($i=0;$i<count($temp5);$i++) {
//         $temp6 = $temp5[$i]['product_id'].'_'.$temp5[$i]['unit_price'];
//         if ($temp6 == $value) {
//             $temp2[$j]['product_name'] = $temp5[$i]['product_name'];
//             $temp2[$j]['product_id'] = $temp5[$i]['product_id'];
//             $temp2[$j]['quantity'] += $temp5[$i]['quantity'];
//             $temp2[$j]['unit_price'] = $temp5[$i]['unit_price'];
//             $temp2[$j]['subtotal'] += $temp5[$i]['subtotal'];
//         }
//     }
//     $j++;                
// }
// sort($temp2);

// for ($i=0;$i<count($temp2);$i++) {  
//     $temp_subtotal = $this->api_helper->convert_number($temp2[$i]['unit_price'],2) * $temp2[$i]['quantity'];
//     $config_data = array(
//         'product_id' => $temp2[$i]['product_id'],
//         'customer_id' => '',
//         'amount' => $temp_subtotal,
//     );
//     $temp_calculate = $this->site->api_calculate_product_tax($config_data);
//     $temp_plt = $temp_plt + $temp_calculate['result'];

//     if ($temp_calculate['result'] > 0) 
//         $temp_total_alcohol += $temp_subtotal;
//     else
//         $temp_total_food += $temp_subtotal;

//     $grand_total += $temp_subtotal;
//     $row++;
//     $j++;
// }
// echo $grand_total.'=';



// $config_data = array(
//     'table_name' => 'sma_product_discount',
//     'select_table' => 'sma_product_discount',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0 and end_date > '2023-06-20' order by id desc",
// );
// $temp = $this->api_helper->api_select_data_v2($config_data);
// for ($i=0;$i<count($temp);$i++) {
//     for ($i2=0;$i2<count($select_customer);$i2++) {
//         if ($select_customer[$i2]['id'] == $temp[$i]['customer_id']) {
//             if ($select_customer[$i2]['parent_id'] == 0) {
//                 $temp[$i][$select_customer[$i2]['id'].'_'.$temp[$i]['product_id']] = $select_customer[$i2]['name']
//             }
//         }
//     }
//$select_customer = $this->api_cache->get_customer_admin();
// for ($i2=0;$i2<count($select_customer);$i2++) {
//     if ($select_customer[$i2]['parent_id'] == 0) {
//         $select_customer[$i2]['temp_id'] = '-'.$select_customer[$i2]['id'].'-';
//         for ($i3=0;$i3<count($select_customer);$i3++) {
//             if ($select_customer[$i3]['parent_id'] == $select_customer[$i2]['id']) {
//                 $select_customer[$i2]['temp_id'] .= '-'.$select_customer[$i3]['id'].'-';
//             }
//         }
//         //echo $select_customer[$i2]['temp_id'].'<br>';
//     }
// }
// for ($i=0;$i<count($temp);$i++) {
//     for ($i2=0;$i2<count($select_customer);$i2++) {
//         if ($select_customer[$i2]['id'] == $temp[$i]['customer_id']) {
//             if ($select_customer[$i2]['parent_id'] == 0) {
//                 echo $select_customer[$i2]['name'].' - '.$temp[$i]['product_id'].'<br>';
                // for ($i3=0;$i3<count($temp);$i3++) {
                //     if ($temp[$i3]['product_id'] == $temp[$i2]['product_id']) {
                //         for ($i4=0;$i4<count($select_customer);$i4++) {
                //             if ($select_customer[$i4]['parent_id'] == $select_customer[$i2]['id']) {
                //                 echo '...:'.$select_customer[$i4]['name'].' - '.$temp[$i]['product_id'].'<br>';
                //             }
                //         }
                //     }
                // }
//                 break;
//             }
//         }
//     }
// }

//835
//1344
// //-addition_price_rate--------------------------------
//     $config_data = array(
//         'customer_id' => 1344,
//     );
//     $temp = $this->site->api_calculate_customer_group_price($config_data);
//     if ($temp['discount_rate'] > 0)
//         $temp_order_discount = $temp_customer->discount_product - $temp['discount_rate'];
//     else
//         $temp_order_discount = abs($temp['discount_rate']) + $temp_customer->discount_product;
//     if ($temp_order_discount < 0)
//         $temp_addition_price_rate = abs($temp_order_discount);
// //-addition_price_rate--------------------------------
// $config_data_2 = array(
//     'id' => 4410,
//     'customer_id' => 1344,
//     'addition_price_rate' => $temp_addition_price_rate,
// );
// $temp = $this->site->api_calculate_product_price_v2($config_data_2);
// $this->api_helper->print_array($temp);


// $config_data = array(
//     'table_name' => 'sma_categories',
//     'select_table' => 'sma_categories',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "parent_id > 0 order by id asc",
// );
// $category_parent = $this->api_helper->api_select_data_v2($config_data);

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0 order by id asc",
// );
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// $k = 0;
// for ($i=0;$i<count($select_data);$i++) {
//     if (strlen($select_data[$i]['c_id']) > 11) {
//         $temp = explode('-',$select_data[$i]['c_id']);
//         $temp_count_main = 0;
//         for ($i2=0;$i2<count($temp);$i2++) {
//             if ($temp[$i2] != '') {
//                 for ($i3=0;$i3<count($category_parent);$i3++) {
//                     if ($category_parent[$i3]['id'] == $temp[$i2]) {
//                         $temp_count_main++;
//                         break;
//                     }
//                 }
//             }
//         }
//         $k++;
//         //echo $select_data[$i]['name'].' ('.$select_data[$i]['code'].') = '.$select_data[$i]['c_id'].' = '.$temp_count_main.'<br>';
//         echo $k.'. '.$select_data[$i]['name'].' ('.$select_data[$i]['code'].')<br>';
//     }
// }

// echo '
// <form action="'.base_url().'main/api_user_login'.'" method="post">
//     <input type="text" name="username" value="apipe">
//     <input type="text" name="password" value="Admin@123456">
//     <input type="submit" value="submit"/>
// </form>
// ';



// $file_path = api_json_data_path.'/report/product/product_report_for_each_customer/2023/product_mode_2023.json';
// $config_data = array(
//     'file_path' => $file_path,
// );
// $temp = $this->api_cache->get_data($config_data);
// $select_product_data = $temp['select_data'];
// $this->api_helper->print_array($select_product_data);

// $config_data = array(
//     'table_name' => 'sma_products',
//     'select_table' => 'sma_products',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id = 6495",
// );
// $select_data = $this->api_helper->api_select_data_v2($config_data);
// $this->sma->print_arrays($select_data);


// $config_data = array(
//     'table_name' => 'sma_companies',
//     'select_table' => 'sma_companies',
//     'translate' => '',
//     'description' => '',
//     'select_condition' => "id > 0"
// );
// $temp = $this->api_helper->api_select_data_v2($config_data);

// $result_array = array();
// foreach ($temp as $row) {
//     $result_array[$row['id']] = $row['company'].' [ Name: '.$row['name'].']';
// }
// $json_data = json_encode($result_array);
// file_put_contents('assets/api/data/stock_manager/json/test/companies.json', $json_data);

// $temp = file_get_contents("assets/api/data/stock_manager/json/test/companies.json");
// $tr_branch = json_decode($temp, true);          
// echo form_dropdown('parent_id', $tr_branch, $_GET['parent_id'], ' id="parent_id" class="form-control"');


// test
// Retrieve sales data for July 2024
// Retrieve sales data for July 2024, filtered by customer_id
$config_data_sales = array(
    'table_name' => 'sma_sales',
    'select_table' => 'sma_sales',
    'translate' => '',
    'description' => '',
    'select_condition' => "date LIKE '2024-07-%' AND customer_id = 2269 ORDER BY date ASC"
);
$sales = $this->api_helper->api_select_data_v2($config_data_sales);

// Initialize arrays to store results
$product_totals = array(); 
$customer_name = ''; // Variable to store the customer name

// Fetch the customer name using the customer_id from the sma_companies table
$config_data_customer = array(
    'table_name' => 'sma_companies',
    'select_table' => 'sma_companies',
    'translate' => '',
    'description' => '',
    'select_condition' => "id = 2269" // Assuming 'id' is the primary key for customer_id
);
$customer_data = $this->api_helper->api_select_data_v2($config_data_customer);

if (!empty($customer_data)) {
    $customer_name = $customer_data[0]['company']; // Assuming 'name' is the field for the customer name
}

// Loop through each sale
for ($i = 0; $i < count($sales); $i++) {
    $sale = $sales[$i];
    $sale_id = $sale['id'];
    
    // Prepare config data to fetch sale items for the current sale
    $config_data_items = array(
        'table_name' => 'sma_sale_items',
        'select_table' => 'sma_sale_items',
        'translate' => '',
        'description' => '',
        'select_condition' => "sale_id = " . $sale_id
    );

    $sale_items = $this->api_helper->api_select_data_v2($config_data_items);

    // Loop through each sale item
    for ($j = 0; $j < count($sale_items); $j++) {
        $item = $sale_items[$j];
        $product_id = $item['product_id'];
        $product_name = $item['product_name'];
        $quantity = $item['quantity'];
        
        // Update the total quantity for this product
        if (!isset($product_totals[$product_id])) {
            $product_totals[$product_id] = array(
                'product_name' => $product_name,
                'total_quantity' => 0
            );
        }
        $product_totals[$product_id]['total_quantity'] += $quantity;
    }
}

// Prepare the output array with total quantities for each product
$product_totals_output = array();
foreach ($product_totals as $product_id => $info) {
    $product_totals_output[] = array(
        'product_id' => $product_id,
        'product_name' => $info['product_name'],
        'total_quantity' => $info['total_quantity'],
        'customer_name' => $customer_name // Include customer_name in the output
    );
}

// Print the product totals
$this->sma->print_arrays($product_totals_output);


?>









