$(document).ready(function(){

    $("#submitOrder").click(function(){
        var staff_id = 0;
        var table_id = 0;
        var tablet_id = 0;
        var foodanddrink_id = 0;

        // Staffs
        var staff = document.getElementsByName('staff[]');
        for (var i = 0, length = staff.length; i < length; i++) {
            if (staff[i].checked) {
                var s_id = staff[i].id;
                var temp = s_id.split("_");
                staff_id = temp[1];
                break;
            }
        }

        // Tables
        var table = document.getElementsByName('table[]');
        for (var i = 0, length = table.length; i < length; i++) {
            if (table[i].checked) {
                var s_id = table[i].id;
                var temp = s_id.split("_");
                table_id = temp[1];
                break;
            }
        }

        // Tablets
        var tablet = document.getElementsByName('tablet[]');
        for (var i = 0, length = tablet.length; i < length; i++) {
            if (tablet[i].checked) {
                var s_id = tablet[i].id;
                var temp = s_id.split("_");
                tablet_id = temp[1];
                break;
            }
        }

        // Food & Drink
        var foodanddrink = document.getElementsByName('foodanddrink[]');
        for (var i = 0, length = foodanddrink.length; i < length; i++) {
            if (foodanddrink[i].checked) {
                var s_id = foodanddrink[i].id;
                var temp = s_id.split("_");
                foodanddrink_id = temp[1];
                break;
            }
        }

        console.log(staff_id + ', ' + table_id + ', ' + tablet_id + ', ' + foodanddrink_id);

        var sendData = {
            staff_id : staff_id,
            table_id : table_id,
            tablet_id : tablet_id,
            foodanddrink_id : foodanddrink_id,
        }

        console.log(sendData);

        $.post( "ajax/submit_order.php", { sendData: sendData }, function( data ) {
            //console.log('Order submited ');
            $.post( "ajax/refresh_order.php", {}, function( data ) {
                console.log('Order Refreshed!')
                $('#table_orders').html(data);
            });
        });
    });

    $( "body" ).on( "click", ".confirm_order", function() {
        var sendData = {id: this.id}

        if (window.confirm("Are you sure?")) {
            $.post( "ajax/confirm_order.php", { sendData: sendData }, function( data ) {
                //console.log('Order confirmed ');
                $.post( "ajax/refresh_order.php", {}, function( data ) {
                    console.log('Order refreshed!')
                    $('#table_orders').html(data);
                });
            });
        }
    });
});