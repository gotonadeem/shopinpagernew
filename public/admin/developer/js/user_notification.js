/**

 * Created by wingstud on 10/8/17.

 */



////load the data......................................................

    dataTable = $('#user-notification-table').DataTable({

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

            url : BASE_URL+'/admin/customer/get-user-notification', // json datasource

            type: "post",  // method  , by default get

            error: function(){  // error handling

                $(".user-table-error").html("");

                $("#user-notification-table").append('<tbody class="user-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');

                //$("#user-table_processing").css("display","none");

            }

        },

        "columnDefs": [ { orderable: false, targets: [0,4] }],

        "order": [[ 2, 'desc' ]]

    });





///delete record...............................

function deleteItem(id){

    var result = confirm("Are you sure you want to delete this notification ?");

    if (result) {

        $('#ajaxLoader').show();

        $.ajax({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            url: BASE_URL+'/admin/customer/user-notification/delete',

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

function publishItem(id){

    var result = confirm("Are you sure to publish this notification ?");

    if (result) {

        $('#ajaxLoader').show();

        $.ajax({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            url: BASE_URL+'/admin/customer/user-notification/publish',

            type: 'POST',

            data: {id: id },

            success: function (data) {

                location.reload();

            },

            error: function () {

                console.log('There is some error in publishing. Please try again.');

            }

        });

        return false;

    }

}




// CLEARABLE INPUT

function change_status(value)

{

  alert(value)

}

