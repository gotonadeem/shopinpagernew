/**
 * Created by wingstud on 10/8/17.
 */

$(function() {

    //Please enter valid email
    jQuery.validator.addMethod("validEmail", function(value, element)
    {
        if(value == '')
            return true;
        var temp1;
        temp1 = true;
        var ind = value.indexOf('@');
        var str2=value.substr(ind+1);
        var str3=str2.substr(0,str2.indexOf('.'));
        if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
            return false;
        var str1=value.substr(0,ind);
        if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
            return false;
        str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]+)$/;
        temp1 = str.test(value);
        return temp1;
    }, "Please enter valid email.");

    //mobile no validation
    jQuery.validator.addMethod('onlyNumbar', function (value, element) {
        if(/^[0-9]+$/i.test(value))
        {
            return true;
        }
    });

    //Alphabet only
    jQuery.validator.addMethod('onlyAlphabets', function (value, element) {
        if(/^[a-zA-Z\s]+$/i.test(value))
        {
            return true;
        }
    });

    $("form[name='add_warehouse']").validate({
        rules: {

            city_id: {
                required: true,
            },
            pincode: {
                required: true,
            },
            name: {
                onlyAlphabets:true,
                required: true
            },
            warehouse_pincode: {
                onlyNumbar:true,
                required: true,
                maxLength:6
            },
            address: {
                required: true,
            },
            lattitude: {
                required: true,
            },
            longitude: {
                required: true,
            },
        },
        // Specify validation error messages
        messages: {
            name: "Please enter a valid name",
            warehouse_pincode: "Please enter a valid pincode",

        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

////load the data......................................................
dataTable = $('#warehouse-table').DataTable({
    pageLength: 25,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        {extend: 'copy'},
        {extend: 'csv'},
        {extend: 'pdf', title: 'ExampleFile'},
        {extend: 'print',
            customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }
    ],
    "oLanguage": {
        "sProcessing": "<img class='loader' src='"+ASSET_URL+"front/image/index.rotating-balls-spinner.svg'>"
    },
    "processing": true,
    "serverSide": true,
    "ajax":{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : BASE_URL+'/admin/warehouse/getWareHouseData', // json datasource
        type: "post",  // method  , by default get
        error: function(){  // error handling
            $(".user-table-error").html("");
            $("#users-table").append('<tbody class="user-table-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
            //$("#user-table_processing").css("display","none");
        }
    },
    "columnDefs": [ { orderable: false, targets: [0,3] }],
    "order": [[ 2, 'desc' ]]
});
//$('.dataTables_filter input').attr("placeholder", "search with name.");
// $('.dataTables_filter input').attr("class", "clearable");
///delete record...............................
function deleteItem(id){
    var result = confirm("Are you sure you want to delete the warehouse ?");
    if (result) {
        $('#ajaxLoader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL+'/admin/warehouse/delete',
            type: 'POST',
            data: {id: id },
            success: function (data) {
                location.reload();
            },
            error: function () {
                console.log('There is some error in user deleting. Please try again.');
            }
        });
        return false;
    }
}
//get tehsil by district id
function getPincode(e) {

    return $("#ajaxLoader").show(), $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: BASE_URL + "/admin/warehouse/get-pincode",
        type: "POST",
        data: {
            id: e
        },
        success: function(e) {
            $("#pincode").html(e)
        },
        error: function() {
            console.log("There is some error to get pincode. Please try again.")
        }
    }), !1

}
// CLEARABLE INPUT
function change_status(value)
{
    alert(value)
}


function subadmin(value1,value2)

{



	var result = confirm("Are you sure you want assign subadmin?");

    if (result) {

        $('#ajaxLoader').show();

        $.ajax({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            url: BASE_URL+'/admin/warehouse/subadmin-permission',

            type: 'POST',

            data: {subadmin_id:value1,w_id:value2},

            success: function (data) {

				

				if(data.status_code)

				{

					  html="<div id='success-alert' class='alert alert-success alert-dismissible'>";

					  html+="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";   

					  html+=""+data.message+"</div>";

					  $("#success_alert").show();

					  $("#success_alert").html(html);

					  $("#success_alert").fadeTo(2000, 500).slideUp(500, function(){

						$("#success_alert").slideUp(500);

					   });

				}

				//alert(data);

               // location.reload();

            },

            error: function () {

                console.log('There is some error in user deleting. Please try again.');

            }

        });

        return false;

    }

}	