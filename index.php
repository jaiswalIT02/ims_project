<?php 
include 'config.php';
//include 'logout.php';

include 'includes/db_connect.php';
include 'inc/function.php';
include 'class/User.php';
include 'class/Product.php';
include 'class/Company.php';
include 'class/Unit.php';
include 'class/Order.php';
include 'class/Stock.php';

include 'ajax_task/ajax_response.php';
//include 'includes/security.php';
 
if(route(0)==''){
    include 'pages/index.php';
    die;
}
else if(route(0)=='dashboard'){
    include 'pages/dashboard.php';
    die;
}
else if(route(0)=='sale_master'){
    include 'pages/sale_master.php';
    die;
}
else if(route(0)=='sale_report'){
    include 'pages/sale_report.php';
    die;
}
else if(route(0)=='add_user'){
    include 'pages/add_user.php';
    die;
}
else if(route(0)=='add_unit'){
    include 'pages/add_unit.php';
    die;
}
else if(route(0)=='dashboard'){
    include 'pages/dashboard.php';
    die;
}
else if(route(0)=='404'){
    include 'pages/404.php';
    die;
}
else if(route(0)=='view_bill'){
    include 'pages/view_bill.php';
    die;
}else if(route(0)=='mod_alloc'){
    include 'pages/mod_alloc.php';
    die;
}else if(route(0)=='404'){
    include 'pages/404.php';
    die;
}else if(route(0)=='details_bill'){
    include 'pages/details_bill.php';
    die;
}else if(route(0)=='purchase_master'){
    include 'pages/purchase_master.php';
    die;
}
else if(route(0)=='outlet_details'){
    include 'pages/outlet_details.php';
    die;
}
else if(route(0)===''){
    include 'pages/404.php';
    die;
}

else if(route(0)=='stock_master'){
    include 'pages/stock_master.php';
    die;
}else if(route(0)=='manage_product'){
    include 'pages/add_product.php';
    die;
}
else if(route(0)=='logout'){
    include 'logout.php';
    die;
}
else if(route(0)=='company_info'){
    include 'pages/company_info.php';
    die;
}
else if(route(0)=='party_info'){
    include 'pages/party_info.php';
    die;
}

